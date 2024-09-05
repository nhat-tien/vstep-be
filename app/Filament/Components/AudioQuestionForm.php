<?php

namespace App\Filament\Components;

use App\Http\Services\Api\FileService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AudioQuestionForm
{
    public static function schema(): array
    {
        return [
            Hidden::make("question_id"),
            FileUpload::make("audio")
                ->disk(FileService::$disk)
                ->directory('question-audios')
                ->getUploadedFileNameForStorageUsing(
                    fn (TemporaryUploadedFile $file): string => FileService::generateFileNameWithDateTime($file),
                )
                ->acceptedFileTypes(["audio/mpeg"])
        ];
    }
}
