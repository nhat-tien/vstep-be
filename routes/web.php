<?php

use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/storage/files/{slug}', FilesController::class)
    ->where('slug', '.*')
    ->middleware('auth:sanctum');

