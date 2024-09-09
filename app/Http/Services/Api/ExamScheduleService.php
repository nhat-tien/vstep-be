<?php

namespace App\Http\Services\Api;

use App\Models\ExamSchedule;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExamScheduleService
{
    private FileService $file;

    public function __construct(FileService $file)
    {
        $this->file = $file;
    }

    public function setAvatar(array $requestData): string
    {
        $path = $this->file->storeAvatar($requestData);
        $examSchedule = ExamSchedule::find($requestData["examScheduleId"]);
        $examSchedule->image_url = $path;
        $examSchedule->save();

        return $path;
    }

    public function bulkCreate(Collection $candidates, array $examInfo): void
    {
        try {

            foreach ($candidates as $candidate) {
                ExamSchedule::create([
                    'user_id' => $candidate->id,
                    'date' => $examInfo['date'],
                    'exam_id' => $examInfo['exam_id']
                ]);
            }
            Notification::make()->success()->title('Success')->icon('heroicon-o-check')->send();
        } catch (\Throwable $th) {
            Notification::make()->danger()->title('Something went wrong')->body($th->getMessage())->send();
        }
    }

    public function done(array $request): void
    {
        try {
            $exam_schedule = ExamSchedule::find($request['scheduleId']);
            $exam_schedule->done = true;
            $exam_schedule->save();
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
}
