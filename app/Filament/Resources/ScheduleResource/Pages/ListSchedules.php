<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSchedules extends ListRecords
{
    protected static string $resource = ScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            "active" => Tab::make("Scheduled")
                ->modifyQueryUsing(fn (Builder $query) => $query->where('done', false)),
            "all" => Tab::make("All"),
            "inactive" => Tab::make("Done")
                ->modifyQueryUsing(fn (Builder $query) => $query->where('done', true)),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'active';
    }
}
