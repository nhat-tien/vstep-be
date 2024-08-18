<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamScheduleResource;
use App\Http\Services\Api\ExamScheduleService;
use App\Models\ExamSchedule;
use Illuminate\Http\Request;

class ExamScheduleController extends Controller
{
    public function __construct(private ExamScheduleService $service)
    {
    }

    public function getSchedule(Request $request): ExamScheduleResource
    {
        $user_id = $request->user()->id;
        $schedule = ExamSchedule::where('user_id', $user_id)->first();
        return new ExamScheduleResource($schedule);
    }
}
