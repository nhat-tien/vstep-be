<?php

namespace App\Filament\Components;

use Filament\Forms\Components\Builder\Block;
use Illuminate\Support\Arr;

class QuestionBuilderForm
{
    public static function schema(array $exclude = []): array
    {
        $components = [
            "para" => Block::make("para")->label("Paragraph Question")
                ->schema(
                    ParagraphQuestionForm::schema()
                ),
            "select" => Block::make("select")->label("Multi-Select Question")
                ->schema(
                    MultiSelectQuestionForm::schema()
                ),
            "audio" => Block::make("audio")->label("Audio Attachment")
                ->schema(
                    AudioQuestionForm::schema()
                ),
            "image" => Block::make("image")->label("Image Attachment")
                ->schema(
                    ImageQuestionForm::schema()
                ),
        ];

            return Arr::except($components, $exclude);
    }
}
