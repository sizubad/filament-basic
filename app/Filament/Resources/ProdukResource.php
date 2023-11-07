<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kategori_id')
                ->required()
                ->relationship('kategori', 'nama'),
                TextInput::make('nama')->required(),
                Textarea::make('deskripsi')->required(),
                FileUpload::make('gambar')->required(),
                Select::make('ukuran')
                ->required()
                ->options([
                'S'=>'S',
                'M'=>'M', 
                'L'=>'L',
                'XL'=>'XL']),
                TextInput::make('harga')->required(),
                TextInput::make('stok')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategori.nama'),
                TextColumn::make('nama'),
                TextColumn::make('deskripsi'),
                ImageColumn::make('gambar'),
                TextColumn::make('ukuran'),
                TextColumn::make('harga'),
                TextColumn::make('stok')
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
            'index' => Pages\ListProduks::route('/'),
            //'create' => Pages\CreateProduk::route('/create'),
            //'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }    
}
