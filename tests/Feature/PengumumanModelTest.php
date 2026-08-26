<?php

namespace Tests\Feature;

use App\Models\Pengumuman;
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
            'admin_id',
        ], $model->getFillable());

        $this->assertArrayHasKey('tanggal', $model->getCasts());
        $this->assertSame('date', $model->getCasts()['tanggal']);
    }
}
