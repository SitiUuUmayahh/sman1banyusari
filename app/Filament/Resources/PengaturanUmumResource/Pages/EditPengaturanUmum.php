<?php

namespace App\Filament\Resources\PengaturanUmumResource\Pages;

use App\Filament\Resources\PengaturanUmumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaturanUmum extends EditRecord
{
    protected static string $resource = PengaturanUmumResource::class;

    protected static ?string $title = 'Pengaturan Umum';

    protected function getHeaderActions(): array
    {
        return [
            Actions\SaveAction::make(),
        ];
    }
}
