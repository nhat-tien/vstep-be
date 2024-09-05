<?php

namespace App\Observers;

use App\Http\Services\Api\FileService;
use App\Models\ExamSchedule;

class ExamScheduleObserver
{
    public function __construct(private FileService $file)
    {
    }
    /**
     * Handle the ExamSchedule "created" event.
     */
    public function created(ExamSchedule $examSchedule): void
    {
        //
    }

    /**
     * Handle the ExamSchedule "updated" event.
     */
    public function updated(ExamSchedule $examSchedule): void
    {
        if($examSchedule->getOriginal('image_url') != null && $examSchedule->isDirty('image_url')) {
            $this->file->deleteFile($examSchedule->getOriginal('image_url'));
        }
    }

    /**
     * Handle the ExamSchedule "deleted" event.
     */
    public function deleted(ExamSchedule $examSchedule): void
    {
        if(!is_null($examSchedule->image_url)) {
            $this->file->deleteFile($examSchedule->image_url);
        }
    }

    /**
     * Handle the ExamSchedule "restored" event.
     */
    public function restored(ExamSchedule $examSchedule): void
    {
        //
    }

    /**
     * Handle the ExamSchedule "force deleted" event.
     */
    public function forceDeleted(ExamSchedule $examSchedule): void
    {
        //
    }
}
