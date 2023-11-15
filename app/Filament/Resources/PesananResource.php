<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                ->required()
                ->relationship('user', 'name'),
                Select::make('produk_id')
                ->required()
                ->relationship('produk', 'nama'),
                Textarea::make('alamat')->required(),
                Textarea::make('catatan')->required(),
                Textarea::make('total_harga')->required(),
                DatePicker::make('tanggal_pesanan')->required(),
                Radio::make('status')
                ->required()
                ->options([
                'Dikirim'=>'dikirim',
                'Selesai'=>'selesai', 
                'Batal'=>'batal'
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('produk.nama')
                ->searchable(),
                TextColumn::make('alamat'),
                TextColumn::make('catatan'),
                TextColumn::make('total_harga'),
                TextColumn::make('tanggal_pesanan'),
                TextColumn::make('status')
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
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            //'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }    
}
