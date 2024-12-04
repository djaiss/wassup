<?php

declare(strict_types=1);

use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\JoinOrganizationController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationSettingsController;
use App\Http\Controllers\PeopleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function (): void {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('organizations', [OrganizationController::class, 'index'])->name('organizations.index');
    Route::get('organizations/new', [OrganizationController::class, 'new'])->name('organizations.new');
    Route::get('organizations/join', [JoinOrganizationController::class, 'new'])->name('organizations.join');

    Route::middleware(['organization'])->group(function (): void {
        Route::get('organizations/{slug}', [OrganizationController::class, 'show'])->name('organizations.show');

        // cycles
        Route::get('organizations/{slug}/cycles/new', [CycleController::class, 'new'])->name('organizations.cycles.new');
        Route::middleware(['cycle'])->group(function (): void {
            Route::get('organizations/{slug}/cycles/{cycle}', [CycleController::class, 'show'])->name('organizations.cycles.show');
            Route::get('organizations/{slug}/cycles/{cycle}/edit', [CycleController::class, 'edit'])->name('organizations.cycles.edit');
            Route::put('organizations/{slug}/cycles/{cycle}', [CycleController::class, 'update'])->name('organizations.cycles.update');
            Route::get('organizations/{slug}/cycles/{cycle}/delete', [CycleController::class, 'delete'])->name('organizations.cycles.delete');
            Route::delete('organizations/{slug}/cycles/{cycle}', [CycleController::class, 'destroy'])->name('organizations.cycles.destroy');

            // goals
            Route::get('organizations/{slug}/cycles/{cycle}/goals', [GoalController::class, 'index'])->name('organizations.goals.index');

            // check-ins
            Route::get('organizations/{slug}/cycles/{cycle}/check-ins', [CheckinController::class, 'index'])->name('organizations.checkins.index');
        });

        Route::get('organizations/{slug}/people', [PeopleController::class, 'index'])->name('organizations.people.index');

        Route::get('organizations/{slug}/settings', [OrganizationSettingsController::class, 'index'])->name('organizations.settings.index');
    });
});
