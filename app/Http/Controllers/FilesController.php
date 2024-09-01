<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Api\ExamScheduleService;
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

}
