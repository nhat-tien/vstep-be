<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionSelectOptionResource\Pages;
use App\Filament\Resources\QuestionSelectOptionResource\RelationManagers;
use App\Models\QuestionSelectOption;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionSelectOptionResource extends Resource
{
    protected static ?string $model = QuestionSelectOption::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

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
                Tables\Columns\TextColumn::make("question_id"),
                Tables\Columns\TextColumn::make("order"),
                Tables\Columns\TextColumn::make("text"),
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
            'index' => Pages\ListQuestionSelectOptions::route('/'),
            'create' => Pages\CreateQuestionSelectOption::route('/create'),
            'edit' => Pages\EditQuestionSelectOption::route('/{record}/edit'),
        ];
    }
}
