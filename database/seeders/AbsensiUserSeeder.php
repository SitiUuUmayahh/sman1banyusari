<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AbsensiUserSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::firstOrCreate(
            ['nama_kelas' => 'XII IPA 1'],
            [
                'shift' => 'pagi',
                'jam_cutoff_masuk' => '07:00:00',
                'jam_mulai_kbm' => '07:15:00',
            ]
        );

        Siswa::updateOrCreate(
            ['nis' => '12345'],
            [
                'nama' => 'Siswa Dummy',
                'password' => Hash::make('12345'),
                'kelas_id' => $kelas->id,
                'no_wa_ortu' => '081234567890',
                'status' => 'aktif',
            ]
        );

        $guruUsers = [
            ['username' => 'guru_piket', 'nama' => 'Guru Piket Dummy', 'role' => 'guru_piket', 'password' => 'guru12345'],
            ['username' => 'admin_tu', 'nama' => 'Admin TU Dummy', 'role' => 'admin_tu', 'password' => 'admin12345'],
            ['username' => 'kepsek', 'nama' => 'Kepala Sekolah Dummy', 'role' => 'kepsek', 'password' => 'kepsek12345'],
        ];

        foreach ($guruUsers as $guruUser) {
            Guru::updateOrCreate(
                ['username' => $guruUser['username']],
                [
                    'nama' => $guruUser['nama'],
                    'password' => Hash::make($guruUser['password']),
                    'no_hp' => '081234567890',
                    'role' => $guruUser['role'],
                ]
            );
        }
    }
}
