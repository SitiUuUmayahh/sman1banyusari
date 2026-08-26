<?php

namespace App\Filament\Resources\GaleriAlbumResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GaleriFotosRelationManager extends RelationManager
{
    protected static string $relationship = 'galeriFotos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('path_foto')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth('1200')
                    ->imageResizeTargetHeight('800')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->disk('public')
                    ->directory('galeri')
                    ->visibility('public')
                    ->required(),
                Forms\Components\TextInput::make('caption')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption')
            ->columns([
                Tables\Columns\ImageColumn::make('path_foto')
                    ->label('Foto')
                    ->disk('public')
                    ->width(150)
                    ->height(100),
                Tables\Columns\TextColumn::make('caption')
                    ->placeholder('Tanpa caption'),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->headerActions([
                Tables\Actions\Action::make('uploadFoto')
                    ->label('Tambah Foto')
                    ->icon('heroicon-o-photo')
                    ->form([
                        Forms\Components\FileUpload::make('path_foto')
                            ->label('Foto')
                            ->image()
                            ->multiple()
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('800')
                            ->imageEditor()
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('galeri')
                            ->visibility('public')
                            ->required(),
                        Forms\Components\TextInput::make('caption')
                            ->label('Caption (opsional)')
                            ->maxLength(255),
                    ])
                    ->action(function (array $data): void {
                        foreach ($data['path_foto'] as $path) {
                            $path = str_replace('\\', '/', $path);
                            $path = Str::startsWith($path, 'galeri/')
                                ? ltrim($path, '/')
                                : 'galeri/' . basename($path);

                            $this->getRelationship()->create([
                                'path_foto' => $path,
                                'caption' => $data['caption'] ?? null,
                            ]);
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
