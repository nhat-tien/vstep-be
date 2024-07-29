<?php

namespace App\Http\Services\Api;

use App\Models\ExamSchedule;
use Illuminate\Http\Request;

class ExamScheduleService
{
    private FileService $file;

    public function __construct(FileService $file)
    {
        $this->file = $file;
    }

    public function setAvatar(Request $request): string
    {
        $path = $this->file->storeAvatar($request);
        $examSchedule = ExamSchedule::find($request->examScheduleId);
        $examSchedule->image_url = $path;
        $examSchedule->save();

        return $path;
    }
}
