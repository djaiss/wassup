<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\ViewModels\CheckinViewModel;
use App\Http\ViewModels\CycleViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WeekController extends Controller
{
    public function show(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');
        $cycle = $request->attributes->get('cycle');
        $weekNumber = (int) $request->route()->parameter('week');

        // Calculer la date du lundi de la semaine demandée
        $cycleStart = $cycle->started_at;
        $weekStart = $cycleStart->copy()->addWeeks($weekNumber - 1)->startOfWeek();

        $data = CycleViewModel::show($cycle);
        $weeks = CheckinViewModel::weekSelector($cycle);
        $members = $organization->members()->with('user')->get();

        return view('organizations.cycles.checkins.index', [
            'organization' => $organization,
            'member' => $member,
            'members' => $members,
            'weeks' => $weeks,
            'cycle' => $data['cycle'],
            'nextCycle' => $data['nextCycle'],
            'previousCycle' => $data['previousCycle'],
            'day' => $weekStart,
        ]);
    }
}
