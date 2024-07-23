<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __invoke(Request $request, string $path): mixed
    {
        abort_if(
            !Storage::disk('files')->exists($path),
            404,
            "The files does not exist"
        );

        return Storage::disk('files')->response($path);
    }
}
