<?php

namespace App\Http\Services\Api;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class FileService {

    public static function generateFileNameByDateTime(UploadedFile $file): string
    {
        $date = date("Y-m-d_H-i-s");
        $ext = $file->getClientOriginalExtension();
        return "{$date}.{$ext}";
    }

    public function storeAvatar(array $requestData): string
    {
        $image = $requestData["avatar"];
        $file_name = FileService::generateFileNameByDateTime($requestData["avatar"]);
        $path = Storage::disk('files')->putFileAs("avatars", $image, $file_name);
        return $path;
    }


}
