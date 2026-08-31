<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanUmumResource\Pages;
use App\Filament\Resources\PengaturanUmumResource\RelationManagers;
use App\Models\AdminUser;
use App\Models\PengaturanUmum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanUmumResource extends Resource
{
    protected static ?string $model = PengaturanUmum::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Umum';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Sekolah')
                    ->schema([
                        Forms\Components\TextInput::make('alamat_sekolah')
                            ->label('Alamat Sekolah')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email_sekolah')
                            ->label('Email Sekolah')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telepon_sekolah')
                            ->label('Telepon Sekolah')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('jumlah_siswa_aktif')
                            ->label('Jumlah Siswa Aktif')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),

                Forms\Components\Section::make('Embed Google Maps')
                    ->schema([
                        Forms\Components\Textarea::make('google_maps_embed_url')
                            ->label('Kode Embed Google Maps')
                            ->hint('Paste the embed code dari Google Maps')
                            ->rows(5),
                    ]),

                Forms\Components\Section::make('Social Media Links')
                    ->description('Kosongkan field untuk tidak menampilkan icon di footer')
                    ->schema([
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('youtube_url')
                            ->label('YouTube URL')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tiktok_url')
                            ->label('TikTok URL')
                            ->url()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('alamat_sekolah')
                    ->label('Alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_sekolah')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telepon_sekolah')
                    ->label('Telepon'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListPengaturanUmums::route('/'),
            'edit' => Pages\EditPengaturanUmum::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = \Filament\Facades\Filament::auth()->user();
        return $user instanceof AdminUser && $user->hasRole('superadmin');
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
}
