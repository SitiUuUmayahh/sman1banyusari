<?php

namespace App\Livewire;

use App\Models\AbsensiLog;
use App\Models\Guru;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GuruPiketDashboard extends Component
{
    public string $search = '';

    public ?int $selectedSiswaId = null;

    public string $status = 'hadir';

    public string $feedback = '';

    public string $feedbackType = '';

    public function render()
    {
        $today = Carbon::today();
        $todayLogs = AbsensiLog::query()
            ->whereDate('tanggal', $today)
            ->whereHas('siswa', fn ($query) => $query->where('status', 'aktif'));

        return view('livewire.guru-piket-dashboard', [
            'guru' => Guru::find(Auth::guard('guru')->id()),
            'stats' => [
                'hadir' => (clone $todayLogs)->where('status_masuk', 'hadir')->count(),
                'terlambat' => (clone $todayLogs)->where('status_masuk', 'terlambat')->count(),
                'belum' => Siswa::where('status', 'aktif')->count() - $todayLogs->count(),
            ],
            'recentLogs' => AbsensiLog::with(['siswa.kelas'])
                ->whereDate('tanggal', $today)
                ->latest('jam_masuk')
                ->limit(20)
                ->get(),
            'students' => $this->studentOptions(),
        ]);
    }

    public function saveManualAttendance(): void
    {
        $this->validate([
            'selectedSiswaId' => ['required', 'integer', 'exists:siswa,id'],
            'status' => ['required', 'in:hadir,terlambat'],
        ], [
            'selectedSiswaId.required' => 'Pilih siswa terlebih dahulu.',
            'selectedSiswaId.exists' => 'Siswa yang dipilih tidak ditemukan.',
        ]);

        $guruId = Auth::guard('guru')->id();
        $today = Carbon::today();
        $now = Carbon::now();

        $saved = DB::transaction(function () use ($today, $now, $guruId): bool {
            $existing = AbsensiLog::query()
                ->where('siswa_id', $this->selectedSiswaId)
                ->whereDate('tanggal', $today)
                ->lockForUpdate()
                ->exists();

            if ($existing) {
                return false;
            }

            AbsensiLog::create([
                'siswa_id' => $this->selectedSiswaId,
                'tanggal' => $today,
                'jam_masuk' => $now,
                'status_masuk' => $this->status,
                'jam_pulang' => null,
                'latitude_scan' => null,
                'longitude_scan' => null,
                'qr_gerbang_id' => null,
                'input_by_type' => 'guru',
                'input_by_id' => $guruId,
            ]);

            return true;
        });

        if (! $saved) {
            $this->feedbackType = 'error';
            $this->feedback = 'Siswa tersebut sudah memiliki absensi hari ini.';

            return;
        }

        $this->reset(['search', 'selectedSiswaId']);
        $this->status = 'hadir';
        $this->feedbackType = 'success';
        $this->feedback = 'Absensi manual berhasil disimpan.';
    }

    public function selectStudent(int $studentId): void
    {
        $this->selectedSiswaId = $studentId;
        $this->search = (string) Siswa::findOrFail($studentId)->nama;
    }

    public function updatedSearch(): void
    {
        if ($this->selectedSiswaId && Siswa::find($this->selectedSiswaId)?->nama !== $this->search) {
            $this->selectedSiswaId = null;
        }
    }

    private function studentOptions()
    {
        if (trim($this->search) === '') {
            return collect();
        }

        $term = trim($this->search);

        return Siswa::with('kelas')
            ->where('status', 'aktif')
            ->where(function ($query) use ($term): void {
                $query->where('nama', 'like', "%{$term}%")
                    ->orWhere('nis', 'like', "%{$term}%");
            })
            ->orderBy('nama')
            ->limit(8)
            ->get();
    }
}
