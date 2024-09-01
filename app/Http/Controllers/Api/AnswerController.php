<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitAnswerRequest;
use App\Http\Requests\SubmitAudioAnswerRequest;
use App\Http\Services\Api\AnswerService;

class AnswerController extends Controller
{
    public function __construct(private AnswerService $service)
    {
    }

    public function submitAnswer(SubmitAnswerRequest $request): void
    {
        $response = $this->service->submitAnswer($request);
        return ;
    }

    public function submitAudioAnswer(SubmitAudioAnswerRequest $request): void
    {

    }
}
