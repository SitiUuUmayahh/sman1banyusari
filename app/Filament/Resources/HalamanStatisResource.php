<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HalamanStatisResource\Pages;
use App\Filament\Resources\HalamanStatisResource\RelationManagers;
use App\Models\HalamanStatis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HalamanStatisResource extends Resource
{
    protected static ?string $model = HalamanStatis::class;

    protected static ?string $modelLabel = 'Halaman Statis';

    protected static ?string $pluralModelLabel = 'Halaman Statis';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('slug')
                    ->options([
                        'sambutan-kepsek' => 'Sambutan Kepala Sekolah',
                        'sejarah' => 'Sejarah',
                        'visi-misi' => 'Visi & Misi',
                        'fasilitas' => 'Fasilitas',
                    ])
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('konten')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->badge(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
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
            'index' => Pages\ListHalamanStatis::route('/'),
            'edit' => Pages\EditHalamanStatis::route('/{record}/edit'),
        ];
    }
}
