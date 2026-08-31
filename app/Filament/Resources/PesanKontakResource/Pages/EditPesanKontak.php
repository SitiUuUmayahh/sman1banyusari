<?php

namespace App\Filament\Resources\PesanKontakResource\Pages;

use App\Filament\Resources\PesanKontakResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPesanKontak extends EditRecord
{
    protected static string $resource = PesanKontakResource::class;

    protected static ?string $title = 'Tandai Status Dibaca';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\SaveAction::make(),
        ];
    }
}
