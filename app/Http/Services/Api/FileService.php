<?php

namespace App\Http\Services\Api;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class FileService {

    public static string $disk = "public";

    public static function generateFileNameWithDateTime(UploadedFile $file): string
    {
        $date = date("Y-m-d_H-i-s");
        $uniqid = uniqid();
        $ext = $file->getClientOriginalExtension();
        return "{$date}-{$uniqid}.{$ext}";
    }

    public function storeAvatar(array $requestData): string
    {
        $image = $requestData["avatar"];
        $file_name = FileService::generateFileNameWithDateTime($requestData["avatar"]);
        $path = Storage::disk(self::$disk)->putFileAs("avatars", $image, $file_name);
        return $path;
    }

    public function storeAudioAnswer(array $requestData): string
    {
        $audio = $requestData["audio"];
        $file_name = FileService::generateFileNameWithDateTime($requestData["audio"]);
        $path = Storage::disk(self::$disk)->putFileAs("answers-audio", $audio, $file_name);
        return $path;
    }

    public function deleteFile(string $file_path): void
    {
        Storage::disk(self::$disk)->delete($file_path);
    }

}
