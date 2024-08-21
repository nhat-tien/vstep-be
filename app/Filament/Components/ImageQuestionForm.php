<?php

namespace App\Filament\Components;

use App\Http\Services\Api\FileService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImageQuestionForm
{
    public static function schema(): array
    {
        return [
            Hidden::make("question_id"),
            FileUpload::make("image")
                ->disk('files')
                ->directory('question-images')
                ->getUploadedFileNameForStorageUsing(
                    fn (TemporaryUploadedFile $file): string => FileService::generateFileNameByDateTime($file),
                )
                ->image()
                ->imageEditor()
        ];
    }
}
