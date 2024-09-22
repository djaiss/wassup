<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\ViewModels\CycleViewModel;
use App\Models\Cycle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CycleController extends Controller
{
    public function new(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');

        return view('organizations.cycles.new', [
            'organization' => $organization,
            'member' => $member,
        ]);
    }

    public function show(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');
        $cycle = $request->attributes->get('cycle');

        $data = CycleViewModel::show($cycle);

        return view('organizations.show', [
            'organization' => $organization,
            'member' => $member,
            'cycle' => $data['cycle'],
            'nextCycle' => $data['nextCycle'],
            'previousCycle' => $data['previousCycle'],
        ]);
    }
}
