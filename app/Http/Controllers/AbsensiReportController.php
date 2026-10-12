<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiReportExport;
use App\Models\AbsensiLog;
use App\Models\Kelas;
use App\Models\NotifikasiWaLog;
use App\Models\Siswa;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiReportController extends Controller
{
    public function laporan(Request $request): View
    {
        [$from, $to] = $this->dateRange($request);

        return view('absensi.admin.laporan', [
            'from' => $from->toDateString(),
            'to' => $to->toDateString(),
            'selectedClass' => $request->integer('kelas_id') ?: null,
            'classes' => Kelas::orderBy('nama_kelas')->get(),
            'rows' => $this->reportRows($from, $to, $request->integer('kelas_id') ?: null),
        ]);
    }

    public function export(Request $request)
    {
        [$from, $to] = $this->dateRange($request);
        $classId = $request->integer('kelas_id') ?: null;
        $rows = $this->reportRows($from, $to, $classId);

        return Excel::download(
            new AbsensiReportExport($rows),
            'laporan-absensi-'.$from->format('Ymd').'-'.$to->format('Ymd').'.xlsx'
        );
    }

    public function notifikasi(Request $request): View
    {
        $logs = NotifikasiWaLog::query()
            ->when($request->filled('status'), fn ($query) => $query->where('status_kirim', $request->string('status')->toString()))
            ->when($request->filled('search'), fn ($query) => $query->where('no_tujuan', 'like', '%'.$request->string('search')->toString().'%'))
            ->latest('dikirim_at')
            ->paginate(15)
            ->withQueryString();

        return view('absensi.admin.notifikasi-wa', [
            'logs' => $logs,
            'status' => $request->string('status')->toString(),
            'search' => $request->string('search')->toString(),
        ]);
    }

    private function dateRange(Request $request): array
    {
        $validated = $request->validate([
            'dari' => ['nullable', 'date'],
            'sampai' => ['nullable', 'date', 'after_or_equal:dari'],
            'kelas_id' => ['nullable', 'integer', 'exists:kelas,id'],
        ]);

        $from = Carbon::parse($validated['dari'] ?? now()->startOfMonth())->startOfDay();
        $to = Carbon::parse($validated['sampai'] ?? now())->startOfDay();

        return [$from, $to];
    }

    private function reportRows(Carbon $from, Carbon $to, ?int $classId)
    {
        $days = CarbonPeriod::create($from->copy()->startOfDay(), $to->copy()->startOfDay())->count();
        $students = Siswa::with('kelas')
            ->where('status', 'aktif')
            ->when($classId, fn ($query) => $query->where('kelas_id', $classId))
            ->orderBy('nama')
            ->get();
        $logs = AbsensiLog::query()
            ->whereBetween('tanggal', [$from->toDateString(), $to->toDateString()])
            ->whereIn('siswa_id', $students->pluck('id'))
            ->get()
            ->groupBy('siswa_id');

        return $students->map(function (Siswa $student) use ($logs, $days): array {
            $studentLogs = $logs->get($student->id, collect());
            $hadir = $studentLogs->where('status_masuk', 'hadir')->count();
            $terlambat = $studentLogs->where('status_masuk', 'terlambat')->count();

            return [
                'nama' => $student->nama,
                'kelas' => $student->kelas?->nama_kelas ?? '-',
                'hadir' => $hadir,
                'terlambat' => $terlambat,
                'alpa' => max(0, $days - $studentLogs->pluck('tanggal')->unique()->count()),
            ];
        });
    }
}
