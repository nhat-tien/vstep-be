<?php

use App\Http\Controllers\Api\AuthController;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "v1", "namespace" => "App\Http\Controllers\Api"], function () {

    Route::post('register', [AuthController::class, 'register']);

    Route::post('login', [AuthController::class, 'login']);

})->middleware('auth:sanctum');
