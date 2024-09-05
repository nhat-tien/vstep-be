<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
use App\Http\Resources\ExamScheduleResource;
use App\Http\Services\Api\ExamScheduleService;
use App\Models\ExamSchedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamScheduleController extends Controller
{
    public function __construct(private ExamScheduleService $service)
    {
    }

    public function show(Request $request): ExamScheduleResource
    {
        $user_id = $request->user()->id;
        $schedule = ExamSchedule::where('user_id', $user_id)->orderBy('date', 'DESC')->first();
        return new ExamScheduleResource($schedule);
    }

    public function setAvatar(StoreImageRequest $request): JsonResponse
    {
        $exam_schedule = ExamSchedule::find($request->examScheduleId);

        if($request->user()->cannot("update", $exam_schedule)) {
            return response()->json([
                'status' => 403,
                'message' => 'forbidden'
            ], 403);
        }

        $path = $this->service->setAvatar($request->safe()->only(['examScheduleId', 'avatar']));

        return response()->json([
            "path" => $path
        ]);
    }
}
