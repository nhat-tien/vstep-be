<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetTimeRequest;
use App\Http\Requests\UpdateTimeRequest;
use App\Http\Services\Api\ResultService;
use Illuminate\Http\JsonResponse;

class ResultController extends Controller
{

    public function __construct(private ResultService $service)
    {}

    public function updateStartTime(UpdateTimeRequest $request): JsonResponse
    {
        $response = $this->service->updateStartTime($request->only(['skillName', 'scheduleId']));
        return response()->json($response,$response->status);
    }

    public function getStartTime(GetTimeRequest $request): JsonResponse
    {
        $response = $this->service->getStartTime($request->query('skill'), $request->query('scheduleId'));
        return response()->json($response,$response->status);
    }

    public function updateEndTime(UpdateTimeRequest $request): JsonResponse
    {
        $response = $this->service->updateEndTime($request->only(['skillName', 'scheduleId']));
        return response()->json($response,$response->status);
    }

    public function getEndTime(GetTimeRequest $request): JsonResponse
    {
        $response = $this->service->updateEndTime($request->only(['skillName', 'scheduleId']));
        return response()->json($response,$response->status);
    }

}
