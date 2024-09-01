<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExamScheduleController;
use App\Http\Controllers\Api\ResultController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnswerController;

Route::group(["prefix" => "v1", "namespace" => "App\Http\Controllers\Api"], function () {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::group(["middleware" => "auth:sanctum"], function () {

        Route::get('/profile', [UserController::class, 'show']);

        Route::delete('/logout', [AuthController::class, 'logout']);

        Route::post('/schedules/avatar', [ExamScheduleController::class, 'setAvatar']);

        Route::put('/result/start-time', [ResultController::class, 'updateStartTime']);

        Route::get('/result/start-time', [ResultController::class, 'getStartTime']);

        Route::put('/result/end-time', [ResultController::class, 'updateEndTime']);

        Route::get('/result/end-time', [ResultController::class, 'getEndTime']);

        Route::get('/schedules', [ExamScheduleController::class, 'show']);

        Route::get('/exam/{exam}', [ExamController::class, 'index']);

        Route::put('/answers', [AnswerController::class, 'submitAnswer']);

        Route::put('/answers/audio', [AnswerController::class, 'submitAudioAnswer']);

    });
});
