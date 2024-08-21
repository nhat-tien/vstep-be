<?php

namespace App\Filament\Components;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;

class AudioQuestionForm
{
    public static function schema(): array
    {
        return [
            Hidden::make("question_id"),
            FileUpload::make("audio")
                ->disk('files')
                ->directory('question-audios')
                ->acceptedFileTypes(["audio/mpeg"])
        ];
    }
}
