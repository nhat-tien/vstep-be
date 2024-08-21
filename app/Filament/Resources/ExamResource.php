<?php

namespace App\Filament\Resources;

use App\Filament\Components\QuestionBuilderForm;
use App\Filament\Resources\ExamResource\Pages;
use App\Models\Exam;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("name"),
                Tabs::make('skills')
                    ->tabs([
                        Tabs\Tab::make('Listening')
                            ->schema([
                                Tabs::make('parts')
                                    ->tabs([
                                        Tabs\Tab::make('Part 1')
                                            ->schema([
                                                Builder::make("listening-part1")->label("Part 1")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                        Tabs\Tab::make('Part 2')
                                            ->schema([
                                                Builder::make("listening-part2")->label("Part 2")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                        Tabs\Tab::make('Part 3')
                                            ->schema([
                                                Builder::make("listening-part3")->label("Part 3")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                    ]),
                            ]),
                        Tabs\Tab::make('Reading')
                            ->schema([
                                Tabs::make('parts')
                                    ->tabs([
                                        Tabs\Tab::make('Part 1')
                                            ->schema([
                                                Builder::make("reading-part1")->label("Part 1")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                        Tabs\Tab::make('Part 2')
                                            ->schema([
                                                Builder::make("reading-part2")->label("Part 2")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                        Tabs\Tab::make('Part 3')
                                            ->schema([
                                                Builder::make("reading-part3")->label("Part 3")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                        Tabs\Tab::make('Part 4')
                                            ->schema([
                                                Builder::make("reading-part4")->label("Part 4")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                    ]),
                            ]),
                        Tabs\Tab::make('Writing')
                            ->schema([
                                Tabs::make('parts')
                                    ->tabs([
                                        Tabs\Tab::make('Part 1')
                                            ->schema([
                                                Builder::make("writing-part1")->label("Part 1")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                        Tabs\Tab::make('Part 2')
                                            ->schema([
                                                Builder::make("writing-part2")->label("Part 2")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                    ]),
                            ]),
                        Tabs\Tab::make('Speaking')
                            ->schema([
                                Tabs::make('parts')
                                    ->tabs([
                                        Tabs\Tab::make('Part 1')
                                            ->schema([
                                                Builder::make("speaking-part1")->label("Part 1")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                        Tabs\Tab::make('Part 2')
                                            ->schema([
                                                Builder::make("speaking-part2")->label("Part 2")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                        Tabs\Tab::make('Part 3')
                                            ->schema([
                                                Builder::make("speaking-part2")->label("Part 2")
                                                    ->blocks(
                                                        QuestionBuilderForm::schema()
                                                    )->collapsible(),
                                            ]),
                                    ]),
                            ]),
                    ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")
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
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
