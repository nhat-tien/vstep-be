<?php

namespace App\Http\Services\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileService {

    public function storeAvatar(Request $request): string
    {
        $image = $request->file('avatar');
        $ext = $request->file('avatar')->getClientOriginalExtension();
        $date = date("Y-m-d-H:i:s");
        $exam_schedule_id = $request->examScheduleId;
        $path = Storage::disk('files')->putFileAs("avatars/{$exam_schedule_id}", $image,"{$date}.{$ext}");
        return $path;
    }

}
