<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ActiveCycleController;
use App\Http\Controllers\Api\CycleController;
use App\Http\Controllers\Api\MeController;
use App\Http\Controllers\Api\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function (): void {
    Route::get('me', [MeController::class, 'show'])->name('me');
    Route::put('me', [MeController::class, 'update']);

    // manage organizations
    Route::get('organizations', [OrganizationController::class, 'index']);
    Route::get('organizations/{organization}', [OrganizationController::class, 'show']);
    Route::post('organizations', [OrganizationController::class, 'create']);

    Route::middleware(['organization.api'])->group(function (): void {
        Route::put('organizations/{organization}', [OrganizationController::class, 'update']);
        Route::delete('organizations/{organization}', [OrganizationController::class, 'destroy']);

        // manage cycles
        Route::get('organizations/{organization}/cycles', [CycleController::class, 'index']);
        Route::get('organizations/{organization}/cycles/active', [ActiveCycleController::class, 'show']);
        Route::post('organizations/{organization}/cycles', [CycleController::class, 'create']);

        Route::middleware(['cycle.api'])->group(function (): void {
            Route::get('organizations/{organization}/cycles/{cycle}', [CycleController::class, 'show']);
            Route::put('organizations/{organization}/cycles/{cycle}', [CycleController::class, 'update']);
            Route::delete('organizations/{organization}/cycles/{cycle}', [CycleController::class, 'destroy']);
        });
    });
});
