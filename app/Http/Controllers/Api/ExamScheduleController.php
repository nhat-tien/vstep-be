<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
use App\Http\Services\Api\ExamScheduleService;
use App\Models\ExamSchedule;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExamScheduleController extends Controller
{
    public function __construct(ExamScheduleService $service)
    {
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
