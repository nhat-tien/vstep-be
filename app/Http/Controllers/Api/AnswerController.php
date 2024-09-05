<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitAnswerRequest;
use App\Http\Requests\SubmitAudioAnswerRequest;
use App\Http\Resources\AnswerCollection;
use App\Http\Resources\AnswerResource;
use App\Http\Services\Api\AnswerService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AnswerController extends Controller
{
    public function __construct(private AnswerService $service)
    {
    }

    public function submitAnswer(SubmitAnswerRequest $request): AnswerCollection
    {
        try {
            $answers = $this->service->submitAnswer($request);
            return new AnswerCollection($answers);
        } catch (\Exception $e) {
             throw new HttpException(500, $e->getMessage());
        }
    }

    public function submitAudioAnswer(SubmitAudioAnswerRequest $request): AnswerResource
    {
        try {
            $answer = $this->service->submitAudioAnswer($request);
            return new AnswerResource($answer);
        } catch (\Exception $e) {
             throw new HttpException(500, $e->getMessage());
        }
    }
}
