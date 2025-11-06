<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use App\Models\Toko;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $pluralModelLabel = 'Pembayaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('toko_id')
                    ->label('Nama Toko')
                    ->options(Toko::all()->pluck('nama_toko', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('kode_pembayaran')
                    ->label('Kode Pembayaran')
                    ->required()
                    ->maxLength(50)
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah Pembayaran')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                Forms\Components\Select::make('metode')
                    ->label('Metode Pembayaran')
                    ->options([
                        'transfer' => 'Transfer Bank',
                        'e-wallet' => 'E-Wallet',
                        'cash' => 'Tunai',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('status')
                    ->label('Status Pembayaran')
                    ->default('berhasil')
                    ->disabled(), // hanya 1 jenis status

                Forms\Components\DatePicker::make('tanggal_pembayaran')
                    ->label('Tanggal Pembayaran')
                    ->placeholder('Pilih tanggal pembayaran')
                    ->displayFormat('Y-m-d')
                    ->native(false)
                    ->default(now()),

                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan Tambahan')
                    ->placeholder('Opsional, misalnya catatan transaksi...')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('toko.nama_toko')
                    ->label('Nama Toko')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('kode_pembayaran')
                    ->label('Kode Pembayaran')
                    ->searchable(),

                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('metode')
                    ->label('Metode'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'berhasil',
                    ])
                    ->icon('heroicon-o-check-circle'),

                Tables\Columns\TextColumn::make('tanggal_pembayaran')
                    ->label('Tanggal Pembayaran')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->label('Dibuat Pada')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->label('Diperbarui Pada')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
