<?php

namespace App\Filament\Resources\AnswerKeyResource\Pages;

use App\Filament\Resources\AnswerKeyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnswerKeys extends ListRecords
{
    protected static string $resource = AnswerKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
