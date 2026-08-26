<?php

namespace Tests\Feature;

use App\Models\Pengumuman;
use Carbon\Carbon;
use Tests\TestCase;

class PengumumanModelTest extends TestCase
{
    public function test_pengumuman_model_has_expected_fillable_and_casts(): void
    {
        $model = new Pengumuman();

        $this->assertSame([
            'judul',
            'konten',
            'tanggal',
            'tanggal_selesai',
            'admin_id',
        ], $model->getFillable());

        $this->assertArrayHasKey('tanggal', $model->getCasts());
        $this->assertSame('date', $model->getCasts()['tanggal']);
        $this->assertArrayHasKey('tanggal_selesai', $model->getCasts());
        $this->assertSame('date', $model->getCasts()['tanggal_selesai']);
    }

    public function test_pengumuman_active_status_uses_date_range_without_start_date_field(): void
    {
        $today = Carbon::today();

        $active = new Pengumuman([
            'tanggal' => $today->copy()->subDay()->toDateString(),
            'tanggal_selesai' => $today->copy()->addDay()->toDateString(),
        ]);

        $archived = new Pengumuman([
            'tanggal' => $today->copy()->subDays(5)->toDateString(),
            'tanggal_selesai' => $today->copy()->subDay()->toDateString(),
        ]);

        $this->assertTrue($active->isAktif());
        $this->assertFalse($archived->isAktif());
    }

    public function test_pengumuman_uses_publication_date_as_effective_start(): void
    {
        $today = Carbon::today();

        $pengumuman = new Pengumuman([
            'tanggal' => $today->copy()->subDay()->toDateString(),
            'tanggal_selesai' => $today->copy()->addDay()->toDateString(),
        ]);

        $this->assertTrue($pengumuman->isAktif());
        $this->assertSame($today->copy()->subDay()->toDateString(), $pengumuman->tanggal->toDateString());
    }
}
