<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetTimeRequest;
use App\Http\Requests\UpdateTimeRequest;
use App\Http\Services\Api\ResultService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ResultResource;

class ResultController extends Controller
{

    public function __construct(private ResultService $service)
    {}

    /**
     *
     * @response array{status: 200, data: ResultResource}
     */
    public function updateStartTime(UpdateTimeRequest $request): JsonResponse
    {
        $response = $this->service->updateStartTime($request->only(['skillName', 'scheduleId']));
        return response()->json($response,$response['status']);
    }

    /**
     *
     * @response array{status: 200, data: ResultResource}
     */
    public function updateEndTime(UpdateTimeRequest $request): JsonResponse
    {
        $response = $this->service->updateEndTime($request->only(['skillName', 'scheduleId']));
        return response()->json($response,$response['status']);
    }

    /**
     *
     * @response array{status: 200, data: ResultResource}
     */
    public function getTime(GetTimeRequest $request): JsonResponse
    {
        $response = $this->service->getTime($request->query('skill'), $request->query('scheduleId'));
        return response()->json($response,$response['status']);
    }

}
