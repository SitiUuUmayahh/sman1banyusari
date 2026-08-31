<?php

namespace App\Filament\Resources\PesanKontakResource\Pages;

use App\Filament\Resources\PesanKontakResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPesanKontak extends ViewRecord
{
    protected static string $resource = PesanKontakResource::class;

    protected static ?string $title = 'Detail Pesan Kontak';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Tandai Dibaca'),
        ];
    }
}
