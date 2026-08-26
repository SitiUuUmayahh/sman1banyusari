<?php

namespace App\Filament\Resources\GaleriAlbumResource\Pages;

use App\Filament\Resources\GaleriAlbumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGaleriAlbum extends EditRecord
{
    protected static string $resource = GaleriAlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
