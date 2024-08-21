<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExamScheduleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "v1", "namespace" => "App\Http\Controllers\Api"], function () {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::group(["middleware" => "auth:sanctum"], function () {

        Route::get('/me', [UserController::class, 'show']);

        Route::delete('/logout', [AuthController::class, 'logout']);

        Route::post('/avatar', [FilesController::class, 'setAvatar']);

        Route::get('/schedules', [ExamScheduleController::class, 'getSchedule']);

        Route::get('/exam/{exam}', [ExamController::class, 'getQuestions']);
    });
});
