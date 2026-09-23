<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class SiswaTemplateExport implements FromArray
{
    public function array(): array
    {
        return [
            ['NIS', 'Nama', 'Kelas', 'No WA Orang Tua'],
            ['12345', 'Contoh Siswa', 'XII IPA 1', '081234567890'],
            ['12346', 'Contoh Siswa 2', 'XII IPA 1', '081234567891'],
        ];
    }
}
