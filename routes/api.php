<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExamScheduleController;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "v1", "namespace" => "App\Http\Controllers\Api"], function () {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::group(["middleware" => "auth:sanctum"], function () {

        //TODO: Add route return user info

        Route::delete('/logout', [AuthController::class, 'logout']);

        Route::post('/avatar', [FilesController::class, 'setAvatar']);

        Route::get('/schedules', [ExamScheduleController::class, 'getSchedule']);

        Route::get('/exam/{exam}/listening', [ExamController::class, 'getListeningQuestions']);

        Route::post('/exam/{exam_id}/listening', []);

        Route::get('/exam/{exam_id}/reading', [ExamController::class, 'getReadingQuestions']);

        Route::post('/exam/{exam_id}/reading', []);

        Route::get('/exam/{exam_id}/writing', [ExamController::class, 'getWritingQuestions']);

        Route::post('/exam/{exam_id}/writing', []);

        Route::get('/exam/{exam_id}/speaking', [ExamController::class, 'getSpeakingQuestions']);

        Route::post('/exam/{exam_id}/speaking', []);
    });
});
