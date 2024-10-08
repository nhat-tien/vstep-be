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

        Route::put('/result/end-time', [ResultController::class, 'updateEndTime']);

        Route::get('/result/time', [ResultController::class, 'getTime']);

        Route::get('/schedules', [ExamScheduleController::class, 'show']);

        Route::post('/schedules/done', [ExamScheduleController::class, 'done']);

        Route::get('/exam/{exam}', [ExamController::class, 'index']);

        Route::get('/exam/{exam}/count', [ExamController::class, 'countSelectQuestion']);

        Route::put('/answers', [AnswerController::class, 'submitAnswer']);

        Route::post('/answers/audio', [AnswerController::class, 'submitAudioAnswer']);

    });
});
