<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Http\Services\Api\FileService;
use App\Models\Exam;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
                                Builder::make("listening")->label("Listening")
                                    ->blocks([
                                        Builder\Block::make("para")->label("Paragraph Question")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                RichEditor::make("text")
                                                    ->disableToolbarButtons([
                                                        'blockquote',
                                                        'strike',
                                                        'codeBlock',
                                                    ])
                                            ]),
                                        Builder\Block::make("select")->label("Multi-Select Question")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                Section::make()->schema([
                                                    TextInput::make("text"),
                                                ]),
                                                Section::make()->schema([
                                                    ToggleButtons::make("answer_key")
                                                        ->options([
                                                            "A" => "A",
                                                            "B" => "B",
                                                            "C" => "C",
                                                            "D" => "D",
                                                        ])->columns(1),
                                                        Section::make()->schema([
                                                        TextInput::make("A"),
                                                        TextInput::make("B"),
                                                        TextInput::make("C"),
                                                        TextInput::make("D"),
                                                    ])->columnStart(2),
                                                ])->columns(5)
                                            ]),
                                        Builder\Block::make("audio")->label("Audio Attachment")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                FileUpload::make("audio")
                                                    ->disk('files')
                                                    ->directory('question-audios')
                                                    ->acceptedFileTypes(["audio/mpeg"])
                                            ]),
                                        Builder\Block::make("image")->label("Image Attachment")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                FileUpload::make("image")
                                                    ->disk('files')
                                                    ->directory('question-images')
                                                    ->getUploadedFileNameForStorageUsing(
                                                        fn (TemporaryUploadedFile $file): string => FileService::generateFileNameByDateTime($file),
                                                    )
                                                    ->image()
                                                    ->imageEditor()
                                            ])
                                    ])->collapsible(),
                            ]),
                        Tabs\Tab::make('Reading')
                            ->schema([
                                Builder::make("reading")->label("Reading")
                                    ->blocks([
                                        Builder\Block::make("para")->label("Paragraph Question")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                RichEditor::make("text")
                                                    ->disableToolbarButtons([
                                                        'blockquote',
                                                        'strike',
                                                        'codeBlock',
                                                    ])
                                            ]),
                                        Builder\Block::make("select")->label("Multi-Select Question")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                Section::make()->schema([
                                                    TextInput::make("text"),
                                                ]),
                                                Section::make()->schema([
                                                    ToggleButtons::make("answer_key")
                                                        ->options([
                                                            "A" => "A",
                                                            "B" => "B",
                                                            "C" => "C",
                                                            "D" => "D",
                                                        ])->columns(1),
                                                        Section::make()->schema([
                                                        TextInput::make("A"),
                                                        TextInput::make("B"),
                                                        TextInput::make("C"),
                                                        TextInput::make("D"),
                                                    ])->columnStart(2),
                                                ])->columns(5)
                                            ]),
                                        Builder\Block::make("image")->label("Image Attachment")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                FileUpload::make("image")
                                                    ->disk('files')
                                                    ->directory('question-images')
                                                    ->getUploadedFileNameForStorageUsing(
                                                        fn (TemporaryUploadedFile $file): string => FileService::generateFileNameByDateTime($file),
                                                    )
                                                    ->image()
                                                    ->imageEditor()
                                            ])
                                    ])->collapsible(),
                            ]),
                        Tabs\Tab::make('Writing')
                            ->schema([
                                Builder::make("writing")->label("Writing")
                                    ->blocks([
                                        Builder\Block::make("para")->label("Paragraph Question")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                RichEditor::make("text")
                                                    ->disableToolbarButtons([
                                                        'blockquote',
                                                        'strike',
                                                        'codeBlock',
                                                    ])
                                            ]),
                                        Builder\Block::make("select")->label("Multi-Select Question")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                Section::make()->schema([
                                                    TextInput::make("text"),
                                                ]),
                                                Section::make()->schema([
                                                    ToggleButtons::make("answer_key")
                                                        ->options([
                                                            "A" => "A",
                                                            "B" => "B",
                                                            "C" => "C",
                                                            "D" => "D",
                                                        ])->columns(1),
                                                        Section::make()->schema([
                                                        TextInput::make("A"),
                                                        TextInput::make("B"),
                                                        TextInput::make("C"),
                                                        TextInput::make("D"),
                                                    ])->columnStart(2),
                                                ])->columns(5)
                                            ]),
                                        Builder\Block::make("image")->label("Image Attachment")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                FileUpload::make("image")
                                                    ->disk('files')
                                                    ->directory('question-images')
                                                    ->getUploadedFileNameForStorageUsing(
                                                        fn (TemporaryUploadedFile $file): string => FileService::generateFileNameByDateTime($file),
                                                    )
                                                    ->image()
                                                    ->imageEditor()
                                            ])
                                    ])->collapsible(),
                            ]),
                        Tabs\Tab::make('Speaking')
                            ->schema([
                                Builder::make("speaking")->label("Speaking")
                                    ->blocks([
                                        Builder\Block::make("para")->label("Paragraph Question")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                RichEditor::make("text")
                                                    ->disableToolbarButtons([
                                                        'blockquote',
                                                        'strike',
                                                        'codeBlock',
                                                    ])
                                            ]),
                                        Builder\Block::make("select")->label("Multi-Select Question")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                Section::make()->schema([
                                                    TextInput::make("text"),
                                                ]),
                                                Section::make()->schema([
                                                    ToggleButtons::make("answer_key")
                                                        ->options([
                                                            "A" => "A",
                                                            "B" => "B",
                                                            "C" => "C",
                                                            "D" => "D",
                                                        ])->columns(1),
                                                        Section::make()->schema([
                                                        TextInput::make("A"),
                                                        TextInput::make("B"),
                                                        TextInput::make("C"),
                                                        TextInput::make("D"),
                                                    ])->columnStart(2),
                                                ])->columns(5)
                                            ]),
                                        Builder\Block::make("audio")->label("Audio Attachment")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                FileUpload::make("audio")
                                                    ->disk('files')
                                                    ->directory('question-audios')
                                                    ->acceptedFileTypes(["audio/mpeg"])
                                            ]),
                                        Builder\Block::make("image")->label("Image Attachment")
                                            ->schema([
                                                Hidden::make("question_id"),
                                                FileUpload::make("image")
                                                    ->disk('files')
                                                    ->directory('question-images')
                                                    ->getUploadedFileNameForStorageUsing(
                                                        fn (TemporaryUploadedFile $file): string => FileService::generateFileNameByDateTime($file),
                                                    )
                                                    ->image()
                                                    ->imageEditor()
                                            ])
                                    ])->collapsible(),
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
