<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\ViewModels\CycleViewModel;
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

        $data = CycleViewModel::show($cycle);

        $members = $organization->members()->with('user')->get();

        return view('organizations.cycles.goals.index', [
            'organization' => $organization,
            'member' => $member,
            'members' => $members,
            'goals' => $goals,
            'cycle' => $data['cycle'],
            'nextCycle' => $data['nextCycle'],
            'previousCycle' => $data['previousCycle'],
        ]);
    }
}
