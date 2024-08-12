<?php

namespace App\Http\Services\Api;

use Illuminate\Support\Facades\Storage;


class FileService {

    public function storeAvatar(array $requestData): string
    {
        $image = $requestData["avatar"];
        $ext = $requestData["avatar"]->getClientOriginalExtension();
        $date = date("Y-m-d-H:i:s");
        $exam_schedule_id = $requestData["examScheduleId"];
        $path = Storage::disk('files')->putFileAs("avatars/{$exam_schedule_id}", $image,"{$date}.{$ext}");
        return $path;
    }

}
