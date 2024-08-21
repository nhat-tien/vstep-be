<?php

namespace App\Filament\Components;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;

class MultiSelectQuestionForm
{
    public static function schema(): array
    {
        return [
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
        ];
    }
}

