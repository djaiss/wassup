<?php

declare(strict_types=1);

arch('models')
    ->expect('App\Models')
    ->toHaveMethod('casts')
    ->ignoring('App\Models\Concerns')
    ->toExtend('Illuminate\Database\Eloquent\Model')
    ->ignoring('App\Models\Concerns')
    ->toOnlyBeUsedIn([
        'App\Actions',
        'App\Http',
        'App\Jobs',
        'App\Livewire',
        'App\Models',
        'App\Providers',
        'Database\Factories',
    ])->ignoring('App\Models\Concerns');

arch('ensure factories', function () {
    expect($models = getModels())->toHaveCount(2);

    foreach ($models as $model) {
        expect($model::factory())
            ->toBeInstanceOf(Illuminate\Database\Eloquent\Factories\Factory::class);
    }
});

/**
 * Get all models in the app/Models directory.
 *
 * @return array<int, class-string<\Illuminate\Database\Eloquent\Model>>
 */
function getModels(): array
{
    $models = glob(__DIR__.'/../../app/Models/*.php');

    return collect($models)
        ->map(function ($file) {
            return 'App\Models\\'.basename($file, '.php');
        })->toArray();
}
