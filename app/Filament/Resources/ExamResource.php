<?php

namespace App\Filament\Resources;

use App\Filament\Components\QuestionBuilderForm;
use App\Filament\Resources\ExamResource\Pages;
use App\Http\Services\Api\ExamService;
use App\Models\Exam;
// use Filament\Forms\Components\Builder;
use App\Models\QuestionSelectOption;
use App\Models\Skill;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public function __construct(private ExamService $service)
    {
    }

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
                                                QuestionBuilderForm::schema("listening-part1", "Part 1")
                                            ]),
                                        Tabs\Tab::make('Part 2')
                                            ->schema([
                                                QuestionBuilderForm::schema("listening-part2", "Part 2")
                                            ]),
                                        Tabs\Tab::make('Part 3')
                                            ->schema([
                                                QuestionBuilderForm::schema("listening-part3", "Part 3")
                                            ]),
                                    ]),
                            ]),
                        Tabs\Tab::make('Reading')
                            ->schema([
                                Tabs::make('parts')
                                    ->tabs([
                                        Tabs\Tab::make('Part 1')
                                            ->schema([
                                                QuestionBuilderForm::schema("reading-part1","Part 1",['audio'])
                                            ]),
                                        Tabs\Tab::make('Part 2')
                                            ->schema([
                                                QuestionBuilderForm::schema("reading-part2","Part 2",['audio'])
                                            ]),
                                        Tabs\Tab::make('Part 3')
                                            ->schema([
                                                QuestionBuilderForm::schema("reading-part3","Part 3",['audio'])
                                            ]),
                                        Tabs\Tab::make('Part 4')
                                            ->schema([
                                                QuestionBuilderForm::schema("reading-part4","Part 4",['audio'])
                                            ]),
                                    ]),
                            ]),
                        Tabs\Tab::make('Writing')
                            ->schema([
                                Tabs::make('parts')
                                    ->tabs([
                                        Tabs\Tab::make('Part 1')
                                            ->schema([
                                                QuestionBuilderForm::schema("writing-part1","Part 1",['audio'])
                                            ]),
                                        Tabs\Tab::make('Part 2')
                                            ->schema([
                                                QuestionBuilderForm::schema("writing-part2","Part 2",['audio'])
                                            ]),
                                    ]),
                            ]),
                        Tabs\Tab::make('Speaking')
                            ->schema([
                                Tabs::make('parts')
                                    ->tabs([
                                        Tabs\Tab::make('Part 1')
                                            ->schema([
                                                QuestionBuilderForm::schema("speaking-part1","Part 1")
                                            ]),
                                        Tabs\Tab::make('Part 2')
                                            ->schema([
                                                QuestionBuilderForm::schema("speaking-part2","Part 2")
                                            ]),
                                        Tabs\Tab::make('Part 3')
                                            ->schema([
                                                QuestionBuilderForm::schema("speaking-part3","Part 3")
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->after(function (Exam $exam) {
                        $questions = $exam->questions();
                        foreach ($questions as $question) {
                            $question->questionSelectOptions()->delete();
                            $question->answerKeys()->delete();
                        }
                        $questions->delete();
                    }),
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
            'view' => Pages\ViewExam::route('/{record}'),
        ];
    }
}
