<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListMedia extends ListRecords
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            "all" => Tab::make("All"),
            "avatar" => Tab::make("Avatar")
                ->modifyQueryUsing(fn (Builder $query) => $query->where('folder', 'avatars')),
            "question-audio" => Tab::make("Audio Question")
                ->modifyQueryUsing(fn (Builder $query) => $query->where('folder', 'question-audios')),
            "question-images" => Tab::make("Image Question")
                ->modifyQueryUsing(fn (Builder $query) => $query->where('folder', 'question-images')),
            "answers-audio" => Tab::make("Audio Answer")
                ->modifyQueryUsing(fn (Builder $query) => $query->where('folder', 'answers-audio')),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'all';
    }
}
