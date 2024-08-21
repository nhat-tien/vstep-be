<?php

namespace App\Filament\Components;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Support\Components\Component;

class ParagraphQuestionForm
{
    public static function schema(): array
    {
        return [
            Hidden::make("question_id"),
            RichEditor::make("text")
                ->disableToolbarButtons([
                    'blockquote',
                    'strike',
                    'codeBlock',
                ]),
        ];
    }
}
