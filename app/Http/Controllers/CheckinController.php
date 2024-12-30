<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\ViewModels\CheckinViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckinController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');
        $cycle = $request->attributes->get('cycle');

        $weeks = CheckinViewModel::weekSelector($cycle);

        $members = $organization->members()->with('user')->get();

        return view('organizations.cycles.checkins.index', [
            'organization' => $organization,
            'member' => $member,
            'members' => $members,
            'weeks' => $weeks,
            'day' => Carbon::now(),
        ]);
    }
}
