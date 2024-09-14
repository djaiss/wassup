<?php

declare(strict_types=1);

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

        Route::get('organizations/{slug}/people', [PeopleController::class, 'index'])->name('organizations.people.index');

        Route::get('organizations/{slug}/settings', [OrganizationSettingsController::class, 'index'])->name('organizations.settings.index');
    });
});
