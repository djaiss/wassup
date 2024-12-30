<?php

declare(strict_types=1);

use App\Http\Middleware\CheckCycle;
use App\Http\Middleware\CheckCycleAPI;
use App\Http\Middleware\CheckOrganization;
use App\Http\Middleware\CheckOrganizationAPI;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'organization' => CheckOrganization::class,
            'cycle' => CheckCycle::class,
            'organization.api' => CheckOrganizationAPI::class,
            'cycle.api' => CheckCycleAPI::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
