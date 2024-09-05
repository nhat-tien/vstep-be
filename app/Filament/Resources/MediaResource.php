<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Infolists\Components\AudioEntry;
use App\Models\Media;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('folder'),
                Tables\Columns\TextColumn::make('file_name'),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        "image" => "success",
                        "audio" => "warning"
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('folder')
                            ->icon('heroicon-o-folder-open')
                            ->weight(FontWeight::Bold),
                        Infolists\Components\TextEntry::make('file_name')
                            ->icon('heroicon-o-tag'),
                        Infolists\Components\TextEntry::make('url')
                            ->icon('heroicon-o-link')
                            ->url(fn (Media $record): string => '/storage/' . $record->url)
                            ->openUrlInNewTab(),
                        Infolists\Components\TextEntry::make('type')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                "image" => "success",
                                "audio" => "warning"
                            }),
                    ]),
                Section::make('Preview')
                    ->schema([
                        Infolists\Components\ImageEntry::make('url')
                        ->label('')
                            ->visible(fn (Media $record): bool => $record->type == 'image'),
                        AudioEntry::make('url')
                        ->label('')
                            ->visible(fn (Media $record): bool => $record->type == 'audio'),
                    ])
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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'view' => Pages\ViewMedia::route('/{record}'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
