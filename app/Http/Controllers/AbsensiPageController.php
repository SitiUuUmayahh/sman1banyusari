<?php

namespace App\Http\Controllers;

use App\Models\AbsensiLog;
use App\Models\QrGerbang;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AbsensiPageController extends Controller
{
    public function scan(): View
    {
        $siswa = Siswa::with('kelas')->findOrFail(Auth::guard('siswa')->id());

        return view('absensi.scan', compact('siswa'));
    }

    public function processScan(Request $request): JsonResponse
    {
        $coordinates = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $gate = QrGerbang::query()->first();

        if (! $gate) {
            return response()->json([
                'message' => 'Data lokasi gerbang sekolah belum tersedia.',
            ], 422);
        }

        $distance = $this->distanceInMeters(
            (float) $coordinates['latitude'],
            (float) $coordinates['longitude'],
            (float) $gate->latitude,
            (float) $gate->longitude,
        );

        if ($distance > (float) $gate->radius_meter) {
            return response()->json([
                'message' => 'Anda berada di luar jangkauan gerbang sekolah.',
                'distance' => round($distance),
                'radius' => $gate->radius_meter,
            ], 422);
        }

        $siswa = Siswa::with('kelas')->findOrFail(Auth::guard('siswa')->id());
        $today = Carbon::today();
        $now = Carbon::now();

        $result = DB::transaction(function () use ($siswa, $today, $now, $gate, $coordinates): array {
            $log = AbsensiLog::query()
                ->where('siswa_id', $siswa->id)
                ->whereDate('tanggal', $today)
                ->lockForUpdate()
                ->first();

            if (! $log) {
                $status = $now->format('H:i:s') <= $siswa->kelas->jam_cutoff_masuk
                    ? 'hadir'
                    : 'terlambat';

                $log = AbsensiLog::create([
                    'siswa_id' => $siswa->id,
                    'tanggal' => $today,
                    'jam_masuk' => $now,
                    'status_masuk' => $status,
                    'latitude_scan' => $coordinates['latitude'],
                    'longitude_scan' => $coordinates['longitude'],
                    'qr_gerbang_id' => $gate->id,
                    'input_by_type' => 'siswa',
                    'input_by_id' => null,
                ]);

                return [
                    'action' => 'masuk',
                    'status' => $status,
                    'time' => $log->jam_masuk->format('H:i'),
                ];
            }

            if (! $log->jam_pulang) {
                $log->update(['jam_pulang' => $now]);

                return [
                    'action' => 'pulang',
                    'status' => 'pulang',
                    'time' => $log->jam_pulang->format('H:i'),
                ];
            }

            return [
                'action' => 'selesai',
                'status' => 'selesai',
                'time' => $log->jam_pulang->format('H:i'),
            ];
        });

        return response()->json($result);
    }

    private function distanceInMeters(float $latitude, float $longitude, float $gateLatitude, float $gateLongitude): float
    {
        $earthRadius = 6_371_000;
        $latitudeDelta = deg2rad($gateLatitude - $latitude);
        $longitudeDelta = deg2rad($gateLongitude - $longitude);
        $a = sin($latitudeDelta / 2) ** 2
            + cos(deg2rad($latitude)) * cos(deg2rad($gateLatitude)) * sin($longitudeDelta / 2) ** 2;

        return $earthRadius * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    public function piket(): View
    {
        return view('absensi.page', ['title' => 'Piket']);
    }

    public function admin(): View
    {
        return view('absensi.page', ['title' => 'Admin']);
    }

    public function laporan(): View
    {
        return view('absensi.page', ['title' => 'Laporan']);
    }
}
