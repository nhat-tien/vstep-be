<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnswerKeyResource\Pages;
use App\Models\AnswerKey;
// use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnswerKeyResource extends Resource
{
    protected static ?string $model = AnswerKey::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = true;

    protected static ?string $navigationGroup = 'Questions';

    protected static ?int $navigationSort = 3;

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
                Tables\Columns\TextColumn::make('question_id'),
                Tables\Columns\TextColumn::make('question_select_option_id'),
                Tables\Columns\TextColumn::make('questionSelectOption.text')->label('Text'),
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
            'index' => Pages\ListAnswerKeys::route('/'),
            'create' => Pages\CreateAnswerKey::route('/create'),
            'edit' => Pages\EditAnswerKey::route('/{record}/edit'),
        ];
    }
}
