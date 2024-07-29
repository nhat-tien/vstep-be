<?php

use App\Http\Controllers\Api\AuthController;
// use Illuminate\Http\Request;
use App\Http\Controllers\Api\ExamScheduleController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "v1", "namespace" => "App\Http\Controllers\Api"], function () {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::group(["middleware" => "auth:sanctum"], function () {

        Route::delete('/logout', [AuthController::class, 'logout']);

        Route::post('/avatar', [ExamScheduleController::class, 'setAvatar']);

    });
});
