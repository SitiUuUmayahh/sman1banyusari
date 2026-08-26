<?php

namespace App\Filament\Resources\PengumumanResource\Pages;

use App\Filament\Resources\PengumumanResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreatePengumuman extends CreateRecord
{
    protected static string $resource = PengumumanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['admin_id'] = Filament::auth()->id();

        return $data;
    }
}
