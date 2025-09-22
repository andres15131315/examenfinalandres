<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\CustomizationController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AppointmentController;

Route::prefix('v1')->group(function () {
    Route::apiResource('businesses', BusinessController::class);
    Route::apiResource('customizations', CustomizationController::class);
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('agendas', AgendaController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('plans', PlanController::class);
    Route::apiResource('statuses', StatusController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('appointments', AppointmentController::class);
});
