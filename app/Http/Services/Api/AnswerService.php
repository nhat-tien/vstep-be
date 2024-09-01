<?php

namespace App\Http\Services\Api;

use Illuminate\Http\Request;

class AnswerService
{
    public function __construct(private FileService $file)
    {
    }

    public function submitAnswer(Request $request): void
    {
        $answer = $request->answers;
        dd($answer);
    }

    public function submitAudioAnswer(): void
    {

    }

}
