<?php

namespace App\Observers;

use App\Http\Services\Api\FileService;
use App\Models\Answer;

class AnswerObserver
{

    public function __construct(private FileService $file)
    {
    }

    /**
     * Handle the Answer "created" event.
     */
    public function created(Answer $answer): void
    {
        //
    }

    /**
     * Handle the Answer "updated" event.
     */
    public function updated(Answer $answer): void
    {
        //
    }

    /**
     * Handle the Answer "deleted" event.
     */
    public function deleted(Answer $answer): void
    {
        if(!is_null($answer->audio_url)) {
            $this->file->deleteFile($answer->audio_url);
        }
    }

    /**
     * Handle the Answer "restored" event.
     */
    public function restored(Answer $answer): void
    {
        //
    }

    /**
     * Handle the Answer "force deleted" event.
     */
    public function forceDeleted(Answer $answer): void
    {
        //
    }
}
