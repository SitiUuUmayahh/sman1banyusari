<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesanKontakResource\Pages;
use App\Filament\Resources\PesanKontakResource\RelationManagers;
use App\Models\AdminUser;
use App\Models\PesanKontak;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesanKontakResource extends Resource
{
    protected static ?string $model = PesanKontak::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Pesan Kontak';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Pengirim')
                    ->disabled(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->disabled(),
                Forms\Components\TextInput::make('subjek')
                    ->label('Subjek')
                    ->disabled(),
                Forms\Components\Textarea::make('pesan')
                    ->label('Pesan')
                    ->disabled()
                    ->rows(8),
                Forms\Components\Toggle::make('sudah_dibaca')
                    ->label('Sudah Dibaca')
                    ->inline(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subjek')
                    ->label('Subjek')
                    ->searchable(),
                Tables\Columns\IconColumn::make('sudah_dibaca')
                    ->label('Status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diterima')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('sudah_dibaca')
                    ->label('Status Dibaca'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->label('Tandai Dibaca')
                    ->modalHeading('Perbarui Status'),
            ])
            ->bulkActions([
                //
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesanKontaks::route('/'),
            'view' => Pages\ViewPesanKontak::route('/{record}'),
            'edit' => Pages\EditPesanKontak::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = \Filament\Facades\Filament::auth()->user();
        return $user instanceof AdminUser && ($user->hasRole('superadmin') || $user->hasRole('editor'));
    }

    public static function canView(Model $record = null): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record = null): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record = null): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

    public static function getNavigationBadge(): ?string
    {
        $count = PesanKontak::where('sudah_dibaca', false)->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
