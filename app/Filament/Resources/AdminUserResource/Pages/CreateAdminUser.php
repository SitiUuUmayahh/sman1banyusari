<?php

namespace App\Filament\Resources\AdminUserResource\Pages;

use App\Filament\Resources\AdminUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdminUser extends CreateRecord
{
    protected static string $resource = AdminUserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['email'] = $data['username'].'@admin.local';

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->record->syncRoles($this->record->role);
    }
}
