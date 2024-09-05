<?php

namespace App\Observers;

use App\Http\Services\Api\FileService;
use App\Models\Question;

class QuestionObserver
{
    public function __construct(private FileService $file)
    {
    }
    /**
     * Handle the Question "created" event.
     */
    public function created(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "updated" event.
     */
    public function updated(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "deleted" event.
     */
    public function deleted(Question $question): void
    {
        if(!is_null($question->file_url)) {
            $this->file->deleteFile($question->file_url);
        }
    }

    /**
     * Handle the Question "restored" event.
     */
    public function restored(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "force deleted" event.
     */
    public function forceDeleted(Question $question): void
    {
        //
    }
}
