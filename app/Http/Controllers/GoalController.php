<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Cache\CycleCache;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GoalController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');
        $cycle = $request->attributes->get('cycle');

        $goals = $cycle->goals()->get();

        $data = CycleCache::make(
            organization: $organization,
            cycle: $cycle
        )->value();

        return view('organizations.cycles.goals.index', [
            'organization' => $organization,
            'member' => $member,
            'goals' => $goals,
            'cycle' => $data['cycle'],
            'nextCycle' => $data['nextCycle'],
            'previousCycle' => $data['previousCycle'],
        ]);
    }
}
