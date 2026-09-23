<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JadwalPiket;
use App\Models\Kelas;
use App\Models\QrGerbang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AbsensiReferenceController extends Controller
{
    public function kelasIndex(): View
    {
        return view('absensi.admin.kelas.index', [
            'classes' => Kelas::withCount('siswa')->orderBy('nama_kelas')->paginate(15),
        ]);
    }

    public function kelasCreate(): View
    {
        return view('absensi.admin.kelas.form', ['class' => new Kelas(['shift' => 'pagi'])]);
    }

    public function kelasStore(Request $request): RedirectResponse
    {
        Kelas::create($this->validatedClass($request));

        return redirect()->route('absensi.admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function kelasEdit(Kelas $class): View
    {
        return view('absensi.admin.kelas.form', compact('class'));
    }

    public function kelasUpdate(Request $request, Kelas $class): RedirectResponse
    {
        $class->update($this->validatedClass($request));

        return redirect()->route('absensi.admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function kelasDestroy(Kelas $class): RedirectResponse
    {
        $studentCount = $class->siswa()->count();

        if ($studentCount > 0) {
            return back()->with('error', "Tidak bisa hapus, masih ada {$studentCount} siswa di kelas ini.");
        }

        $class->delete();

        return back()->with('success', 'Kelas berhasil dihapus.');
    }

    public function jadwalIndex(): View
    {
        return view('absensi.admin.jadwal-piket.index', [
            'schedules' => JadwalPiket::with('guru')->orderByRaw("CASE hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Minggu' THEN 7 ELSE 8 END")->orderBy('jam_mulai')->paginate(15),
        ]);
    }

    public function jadwalCreate(): View
    {
        return view('absensi.admin.jadwal-piket.form', [
            'schedule' => new JadwalPiket(['hari' => 'Senin']),
            'teachers' => Guru::where('role', 'guru_piket')->orderBy('nama')->get(),
        ]);
    }

    public function jadwalStore(Request $request): RedirectResponse
    {
        JadwalPiket::create($this->validatedSchedule($request));

        return redirect()->route('absensi.admin.jadwal-piket.index')->with('success', 'Jadwal piket berhasil ditambahkan.');
    }

    public function jadwalEdit(JadwalPiket $schedule): View
    {
        return view('absensi.admin.jadwal-piket.form', [
            'schedule' => $schedule,
            'teachers' => Guru::where('role', 'guru_piket')->orderBy('nama')->get(),
        ]);
    }

    public function jadwalUpdate(Request $request, JadwalPiket $schedule): RedirectResponse
    {
        $schedule->update($this->validatedSchedule($request));

        return redirect()->route('absensi.admin.jadwal-piket.index')->with('success', 'Jadwal piket berhasil diperbarui.');
    }

    public function jadwalDestroy(JadwalPiket $schedule): RedirectResponse
    {
        $schedule->delete();

        return back()->with('success', 'Jadwal piket berhasil dihapus.');
    }

    public function qrIndex(): View
    {
        return view('absensi.admin.qr-gerbang.index', [
            'gates' => QrGerbang::orderBy('lokasi')->paginate(15),
        ]);
    }

    public function qrCreate(): View
    {
        return view('absensi.admin.qr-gerbang.form', ['gate' => new QrGerbang(['radius_meter' => 50])]);
    }

    public function qrStore(Request $request): RedirectResponse
    {
        QrGerbang::create([...$this->validatedGate($request), 'token' => (string) Str::uuid()]);

        return redirect()->route('absensi.admin.qr-gerbang.index')->with('success', 'Titik gerbang berhasil ditambahkan.');
    }

    public function qrEdit(QrGerbang $gate): View
    {
        return view('absensi.admin.qr-gerbang.form', compact('gate'));
    }

    public function qrUpdate(Request $request, QrGerbang $gate): RedirectResponse
    {
        $gate->update($this->validatedGate($request));

        return redirect()->route('absensi.admin.qr-gerbang.index')->with('success', 'Titik gerbang berhasil diperbarui.');
    }

    public function qrDestroy(QrGerbang $gate): RedirectResponse
    {
        if ($gate->absensiLogs()->exists()) {
            return back()->with('error', 'Titik gerbang tidak bisa dihapus karena sudah dipakai dalam riwayat absensi.');
        }

        $gate->delete();

        return back()->with('success', 'Titik gerbang berhasil dihapus.');
    }

    private function validatedClass(Request $request): array
    {
        return $request->validate([
            'nama_kelas' => ['required', 'string', 'max:255'],
            'shift' => ['required', 'in:pagi,siang'],
            'jam_cutoff_masuk' => ['required', 'date_format:H:i'],
            'jam_mulai_kbm' => ['required', 'date_format:H:i'],
        ]);
    }

    private function validatedSchedule(Request $request): array
    {
        return $request->validate([
            'guru_id' => [
                'required',
                Rule::exists('guru', 'id')->where(fn ($query) => $query->where('role', 'guru_piket')),
            ],
            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
        ]);
    }

    private function validatedGate(Request $request): array
    {
        return $request->validate([
            'lokasi' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'radius_meter' => ['required', 'integer', 'min:1', 'max:100000'],
        ]);
    }
}
