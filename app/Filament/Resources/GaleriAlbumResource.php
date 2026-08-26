<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriAlbumResource\Pages;
use App\Filament\Resources\GaleriAlbumResource\RelationManagers;
use App\Models\GaleriAlbum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GaleriAlbumResource extends Resource
{
    protected static ?string $model = GaleriAlbum::class;

    protected static ?string $modelLabel = 'Galeri Album';

    protected static ?string $pluralModelLabel = 'Galeri Album';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul_album')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal')
                    ->default(today())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul_album')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->formatStateUsing(fn ($state): ?string => $state
                        ? $state->locale('id')->translatedFormat('d F Y')
                        : null)
                    ->sortable(),
                Tables\Columns\TextColumn::make('galeriFotos_count')
                    ->label('Jumlah Foto')
                    ->counts('galeriFotos')
                    ->badge(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('tanggal', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\GaleriFotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGaleriAlbums::route('/'),
            'create' => Pages\CreateGaleriAlbum::route('/create'),
            'edit' => Pages\EditGaleriAlbum::route('/{record}/edit'),
        ];
    }
}
