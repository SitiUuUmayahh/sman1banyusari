<?php

namespace Tests\Feature;

use App\Models\Prestasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AchievementFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_prestasi_filter_returns_only_selected_tingkat(): void
    {
        Prestasi::create([
            'judul' => 'Prestasi Sekolah',
            'tingkat' => 'sekolah',
            'tahun' => 2026,
        ]);
        Prestasi::create([
            'judul' => 'Prestasi Internasional',
            'tingkat' => 'internasional',
            'tahun' => 2026,
        ]);

        $response = $this->get(route('achievement.index', ['tingkat' => 'internasional']));

        $response->assertOk();
        $response->assertSee('Prestasi Internasional');
        $response->assertDontSee('Prestasi Sekolah');
    }
}
