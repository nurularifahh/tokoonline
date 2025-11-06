<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_produk')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('nama_toko')
                    ->required()
                    ->maxLength(100),

                Forms\Components\DatePicker::make('tgl_pesanan')
                    ->required(),

                Forms\Components\TextInput::make('total_harga')
                    ->required()
                    ->numeric(),

                // ✅ Ganti TextInput dengan Select untuk enum status_pesanan
                Forms\Components\Select::make('status_pesanan')
                    ->label('Status Pesanan')
                    ->options([
                        'Menunggu' => 'Menunggu',
                        'Diproses' => 'Diproses',
                        'Dikirim' => 'Dikirim',
                        'Selesai' => 'Selesai',
                        'Dibatalkan' => 'Dibatalkan',
                    ])
                    ->default('menunggu')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_produk')->searchable(),
                Tables\Columns\TextColumn::make('nama_toko')->searchable(),
                Tables\Columns\TextColumn::make('tgl_pesanan')->date()->sortable(),
                Tables\Columns\TextColumn::make('total_harga')->numeric()->sortable(),
                
                // ✅ tampilkan label status dengan badge warna
                Tables\Columns\BadgeColumn::make('status_pesanan')
                    ->colors([
                        'secondary' => 'Menunggu',
                        'warning' => 'Diproses',
                        'info' => 'Dikirim',
                        'success' => 'Selesai',
                        'danger' => 'Dibatalkan',
                    ])
                    ->label('Status'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
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
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
