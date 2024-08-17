<?php

namespace App\Filament\Resources\QuestionSelectOptionResource\Pages;

use App\Filament\Resources\QuestionSelectOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionSelectOptions extends ListRecords
{
    protected static string $resource = QuestionSelectOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
