<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/storage/files/{slug}',[FilesController::class, 'getFile'])
//     ->where('slug', '.*');
