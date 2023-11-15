<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pesanan_id')
                ->required()
                ->relationship('pesanan', 'id'),
                Radio::make('status')
                ->required()
                ->options([
                'Belum Bayar'=>'belum bayar',
                'Sudah Bayar'=>'sudah bayar'
                ]),
                Radio::make('metode_pembayaran')
                ->required()
                ->options([
                'COD'=>'cod',
                'DANA'=>'dana',
                'TF'=>'tf'
                ]),
                DatePicker::make('tanggal_transaksi')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pesanan.user.name')
                ->searchable(),
                TextColumn::make('status'),
                TextColumn::make('metode_pembayaran'),
                TextColumn::make('tanggal_transaksi')

            ])
            ->filters([
                //
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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            //'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }    
}
