<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiResource\Pages;
use App\Filament\Resources\PrestasiResource\RelationManagers;
use App\Models\Prestasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static ?string $modelLabel = 'Prestasi';

    protected static ?string $pluralModelLabel = 'Prestasi';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->placeholder('Juara 1 OSN Matematika Tingkat Provinsi')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_siswa')
                    ->maxLength(255),
                Forms\Components\Select::make('tingkat')
                    ->options([
                        'sekolah' => 'Sekolah',
                        'kabupaten' => 'Kabupaten',
                        'provinsi' => 'Provinsi',
                        'nasional' => 'Nasional',
                        'internasional' => 'Internasional',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('tahun')
                    ->numeric()
                    ->integer()
                    ->required()
                    ->rules(['digits:4']),
                Forms\Components\FileUpload::make('gambar')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth('1200')
                    ->imageResizeTargetHeight('800')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->disk('public')
                    ->directory('prestasi')
                    ->visibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->disk('public')
                    ->size(64),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_siswa')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->placeholder('Tidak ada'),
                Tables\Columns\TextColumn::make('tingkat')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->color(fn (string $state): string => match ($state) {
                        'sekolah' => 'gray',
                        'kabupaten' => 'info',
                        'provinsi' => 'success',
                        'nasional' => 'warning',
                        'internasional' => 'purple',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('tahun')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tingkat')
                    ->options([
                        'sekolah' => 'Sekolah',
                        'kabupaten' => 'Kabupaten',
                        'provinsi' => 'Provinsi',
                        'nasional' => 'Nasional',
                        'internasional' => 'Internasional',
                    ]),
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
            ->defaultSort('tahun', 'desc');
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
            'index' => Pages\ListPrestasis::route('/'),
            'create' => Pages\CreatePrestasi::route('/create'),
            'edit' => Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }
}
