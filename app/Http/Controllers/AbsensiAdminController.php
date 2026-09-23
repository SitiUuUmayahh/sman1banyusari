<?php

namespace App\Http\Controllers;

use App\Exports\SiswaTemplateExport;
use App\Imports\SiswaPreviewImport;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiAdminController extends Controller
{
    public function dashboard(): View
    {
        return view('absensi.admin.dashboard', [
            'activeStudents' => Siswa::where('status', 'aktif')->count(),
            'classCount' => Kelas::count(),
        ]);
    }

    public function importForm(): View
    {
        return view('absensi.admin.import-siswa', [
            'preview' => Session::get('siswa_import_preview'),
            'result' => session('siswa_import_result'),
        ]);
    }

    public function previewImport(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx', 'max:5120'],
        ]);

        $sheets = Excel::toArray(new SiswaPreviewImport(), $request->file('file'));
        $rows = $sheets[0] ?? [];
        $preview = [];
        $seenNis = [];

        foreach ($rows as $index => $row) {
            $normalized = [
                'nis' => trim((string) ($row['nis'] ?? '')),
                'nama' => trim((string) ($row['nama'] ?? '')),
                'kelas' => trim((string) ($row['kelas'] ?? '')),
                'no_wa_ortu' => trim((string) ($row['no_wa_orang_tua'] ?? $row['no_wa_ortu'] ?? '')),
            ];

            if (implode('', $normalized) === '') {
                continue;
            }

            $normalized['row'] = $index + 2;
            $normalized['kelas_ditemukan'] = Kelas::whereRaw('LOWER(nama_kelas) = ?', [mb_strtolower($normalized['kelas'])])->exists();
            $normalized['nis_valid'] = $normalized['nis'] !== '';
            $normalized['nama_valid'] = $normalized['nama'] !== '';
            $normalized['no_wa_valid'] = $normalized['no_wa_ortu'] !== '';
            $normalized['duplicate_nis'] = $normalized['nis'] !== '' && isset($seenNis[$normalized['nis']]);
            if ($normalized['nis'] !== '') {
                $seenNis[$normalized['nis']] = true;
            }
            $normalized['valid'] = $normalized['kelas_ditemukan']
                && $normalized['nis_valid']
                && $normalized['nama_valid']
                && $normalized['no_wa_valid']
                && ! $normalized['duplicate_nis'];
            $existing = $normalized['nis'] !== ''
                ? Siswa::with('kelas')->where('nis', $normalized['nis'])->first()
                : null;
            $normalized['type'] = ! $normalized['valid'] ? 'failed' : ($existing ? 'update' : 'new');
            $normalized['existing'] = $existing ? [
                'nama' => $existing->nama,
                'kelas' => $existing->kelas?->nama_kelas,
                'no_wa_ortu' => $existing->no_wa_ortu,
            ] : null;
            $normalized['changes'] = $existing ? $this->studentChanges($existing, $normalized) : [];
            $normalized['reason'] = ! $normalized['nis_valid']
                ? 'NIS wajib diisi'
                : (! $normalized['nama_valid']
                    ? 'Nama wajib diisi'
                    : (! $normalized['no_wa_valid']
                        ? 'No WA orang tua wajib diisi'
                        : ($normalized['duplicate_nis']
                            ? 'NIS duplikat dalam file'
                            : (! $normalized['kelas_ditemukan'] ? 'Kelas tidak ditemukan' : null))));
            $preview[] = $normalized;
        }

        if ($preview === []) {
            return back()->withErrors(['file' => 'File tidak memiliki data siswa yang dapat dipreview.']);
        }

        Session::put('siswa_import_preview', $preview);
        Session::forget('siswa_import_result');

        return redirect()->route('absensi.admin.import-siswa');
    }

    public function confirmImport(Request $request): RedirectResponse
    {
        $preview = Session::get('siswa_import_preview', []);

        if ($preview === []) {
            return redirect()->route('absensi.admin.import-siswa')
                ->withErrors(['file' => 'Preview import sudah tidak tersedia. Upload ulang file Excel.']);
        }

        $result = [
            'created' => 0,
            'updated' => 0,
            'failed' => [],
        ];

        DB::transaction(function () use ($preview, &$result): void {
            foreach ($preview as $row) {
                if (! $row['valid']) {
                    $result['failed'][] = [
                        'row' => $row['row'],
                        'nis' => $row['nis'],
                        'nama' => $row['nama'],
                        'reason' => $row['reason'],
                    ];
                    continue;
                }

                $kelas = Kelas::whereRaw('LOWER(nama_kelas) = ?', [mb_strtolower($row['kelas'])])->first();

                if (! $kelas) {
                    $result['failed'][] = [
                        'row' => $row['row'],
                        'nis' => $row['nis'],
                        'nama' => $row['nama'],
                        'reason' => 'Kelas tidak ditemukan',
                    ];
                    continue;
                }

                $student = Siswa::where('nis', $row['nis'])->first();

                if ($student) {
                    $student->update([
                        'nama' => $row['nama'],
                        'kelas_id' => $kelas->id,
                        'no_wa_ortu' => $row['no_wa_ortu'],
                    ]);
                    $result['updated']++;
                    continue;
                }

                Siswa::create([
                    'nis' => $row['nis'],
                    'nama' => $row['nama'],
                    'password' => Hash::make($row['nis']),
                    'kelas_id' => $kelas->id,
                    'no_wa_ortu' => $row['no_wa_ortu'],
                    'status' => 'aktif',
                ]);
                $result['created']++;
            }
        });

        Session::forget('siswa_import_preview');

        return redirect()->route('absensi.admin.import-siswa')
            ->with('siswa_import_result', $result)
            ->with('success', sprintf(
                '%d siswa baru ditambahkan, %d siswa diperbarui, %d baris gagal.',
                $result['created'],
                $result['updated'],
                count($result['failed']),
            ));
    }

    public function cancelImport(): RedirectResponse
    {
        Session::forget('siswa_import_preview');

        return redirect()->route('absensi.admin.import-siswa')
            ->with('success', 'Preview import dibatalkan. Tidak ada data yang diubah.');
    }

    public function downloadTemplate()
    {
        return Excel::download(new SiswaTemplateExport(), 'template-import-siswa.xlsx');
    }

    private function studentChanges(Siswa $student, array $row): array
    {
        $changes = [];

        if ($student->nama !== $row['nama']) {
            $changes[] = "Nama: {$student->nama} -> {$row['nama']}";
        }

        if (mb_strtolower((string) $student->kelas?->nama_kelas) !== mb_strtolower($row['kelas'])) {
            $changes[] = 'Kelas: '.($student->kelas?->nama_kelas ?? '-').' -> '.$row['kelas'];
        }

        if ((string) $student->no_wa_ortu !== $row['no_wa_ortu']) {
            $changes[] = 'No WA orang tua berubah';
        }

        return $changes;
    }
}
