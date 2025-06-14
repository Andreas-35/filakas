<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembelianItemResource\Pages;
use App\Filament\Resources\PembelianItemResource\RelationManagers;
use App\Models\Pembelian;
use App\Models\PembelianItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Set;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembelianItemResource extends Resource
{
    protected static ?string $model = PembelianItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $pembelian = new Pembelian();
        if(request()->filled('pembelian_id'))
        $pembelian = \App\Models\Pembelian::find(request('pembelian_id'));
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal Pembelian')
                ->required()
                ->default($pembelian->tanggal)
                ->disabled()
                ->columnSpanFull(),
                Forms\Components\TextInput::make('supplier_id')
                ->label('supplier')
                ->required()
                ->disabled()
                ->default($pembelian->supplier?->nama),
                Forms\Components\TextInput::make('supplier_id')
                ->label('Email Supplier')
                ->required()
                ->disabled()
                ->default($pembelian->supplier?->email),
                Forms\Components\Select::make('barang_id')
                ->label('Barang')
                ->required()
                ->options(
                    \App\Models\Barang::all()->pluck('nama','id')
                )->reactive()
                ->afterStateUpdated(function ($state, Set $set){
                    $barang = \App\Models\Barang::find($state);
                    $set('harga',$barang->harga);
                }),
                Forms\Components\TextInput::make('jumlah')
                ->label('Jumlah Barang'),
                Forms\Components\TextInput::make('harga')
                ->label('Harga Barang'),
                Forms\Components\Hidden::make('pembelian_id')
                ->default(request('pembelian_id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembelianItems::route('/'),
            'create' => Pages\CreatePembelianItem::route('/create'),
            'edit' => Pages\EditPembelianItem::route('/{record}/edit'),
        ];
    }
}
