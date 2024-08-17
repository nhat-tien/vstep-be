<?php

namespace App\Filament\Resources\AnswerKeyResource\Pages;

use App\Filament\Resources\AnswerKeyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnswerKey extends EditRecord
{
    protected static string $resource = AnswerKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
