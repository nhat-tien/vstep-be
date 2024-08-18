<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImageRequest;
use App\Http\Services\Api\ExamScheduleService;
use App\Models\ExamSchedule;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct(private ExamScheduleService $scheduleService)
    {
    }

    public function getFile(Request $request, string $path): mixed
    {
        abort_if(
            !Storage::disk('files')->exists($path),
            404,
            "The files does not exist"
        );

        return Storage::disk('files')->response($path);
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

        $path = $this->scheduleService->setAvatar($request->safe()->only(['examScheduleId', 'avatar']));

        return response()->json([
            "path" => $path
        ]);
    }
}
