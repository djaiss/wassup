<?php

namespace App\Http\ViewModels;

use App\Models\Cycle;

class CycleViewModel
{
    public static function show(Cycle $cycle): array
    {
        $nextCycle = $cycle->organization->cycles()
            ->where('number', $cycle->number + 1)
            ->first();

        $previousCycle = $cycle->organization->cycles()
            ->where('number', $cycle->number - 1)
            ->first();

        return [
            'cycle' => $cycle,
            'nextCycle' => $nextCycle,
            'previousCycle' => $previousCycle,
        ];
    }
}
