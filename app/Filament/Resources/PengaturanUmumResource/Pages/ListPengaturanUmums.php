<?php

namespace App\Filament\Resources\PengaturanUmumResource\Pages;

use App\Filament\Resources\PengaturanUmumResource;
use App\Models\PengaturanUmum;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanUmums extends ListRecords
{
    protected static string $resource = PengaturanUmumResource::class;

    protected static ?string $title = 'Pengaturan Umum';

    public function mount(): void
    {
        parent::mount();

        // Redirect to edit page with the singleton record
        $record = PengaturanUmum::getInstance();
        $this->redirect(
            PengaturanUmumResource::getUrl('edit', ['record' => $record->id])
        );
    }
}
