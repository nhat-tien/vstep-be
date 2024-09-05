<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Sushi\Sushi;

class Media extends Model
{
    use Sushi;

    public function getRows(): array
    {

        $except = [
            ".gitignore"
        ];
        $array = Storage::disk('public')->allFiles('/');
        $models = [];
        $id = 1;
        $array = array_diff($array, $except);
        foreach ($array as $item) {
            [$folder, $file_name] = explode("/", $item);

            $models[] = [
                "id" => $id++,
                "folder" => $folder,
                "file_name" => $file_name,
                "url" => $item,
                "type" => $this->getTypeOfMedia($file_name),
            ];
        }
        return $models;
    }

    private function getTypeOfMedia(string $file_name): string
    {
        $ext = substr($file_name,-3,3);

        return match ($ext) {
            'mp3' => 'audio',
            'jpg' => 'image',
            'png' => 'image',
        };
    }
}
