<?php

namespace App\Http\ViewModels;

use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Member;
use Illuminate\Support\Collection;

class GoalViewModel
{
    public static function index(Cycle $cycle, Member $member): Collection
    {
        return Goal::where('cycle_id', $cycle->id)
            ->where('member_id', $member->id)
            ->get()
            ->map(fn (Goal $goal) => self::goal($goal));
    }

    public static function goal(Goal $goal): array
    {
        return [
            'id' => $goal->id,
            'title' => $goal->title,
            'description' => $goal->description,
        ];
    }
}
