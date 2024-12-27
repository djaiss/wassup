<?php

declare(strict_types=1);

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
        Route::get('cycles', [CycleController::class, 'index']);
        Route::middleware(['cycle'])->group(function (): void {
            Route::get('cycles/{cycle}', [CycleController::class, 'show']);
            Route::post('cycles', [CycleController::class, 'create']);
            Route::put('cycles/{cycle}', [CycleController::class, 'update']);
            Route::delete('cycles/{cycle}', [CycleController::class, 'destroy']);
        });
    });
});
