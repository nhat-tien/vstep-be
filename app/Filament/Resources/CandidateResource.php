<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidateResource\Pages;
use App\Filament\Resources\CandidateResource\RelationManagers;
use App\Http\Services\Api\ExamScheduleService;
use App\Models\Exam;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class CandidateResource extends Resource
{

    protected static ?string $modelLabel = 'candidate';

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->required()->email(),
                Forms\Components\TextInput::make('password')
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
                Forms\Components\TextInput::make('phone_number'),
                Forms\Components\ToggleButtons::make('sex')
                    ->options([
                        "M" => "Male",
                        "F" => "Female"
                    ])
                    ->grouped(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label("Họ và tên"),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\IconColumn::make("sex")->label("Male")->icon(fn (string $state): string => match ($state) {
                    "M" => 'heroicon-o-x-mark',
                    "F" => ''
                }),
                Tables\Columns\TextColumn::make('phone_number')->label("SĐT"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('date')
                    ->label('Create New Exam')
                    ->form([
                        Forms\Components\Select::make('exam_id')
                            ->options(Exam::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable(),
                        Forms\Components\DatePicker::make("date")
                            ->label('Date')
                            ->displayFormat("d/m/Y")
                            ->native(false)
                            ->required()
                    ])
                    ->action(function (array $data, Collection $records, ExamScheduleService $scheduleService): void {
                        $scheduleService->bulkCreate($records, $data);
                    })
                    ->modalWidth(MaxWidth::Medium)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'edit' => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('role', function ($query) {
            $query->where('role_name', 'candidate');
        });
    }
}
