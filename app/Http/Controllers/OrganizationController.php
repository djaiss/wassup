<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\CycleViewModel;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    public function new(): View
    {
        return view('organizations.new');
    }

    public function index(): View
    {
        $organizations = Auth::user()->members()
            ->with('organization')
            ->get()
            ->map(fn (Member $member): array => [
                'id' => $member->organization->id,
                'name' => $member->organization->name,
                'slug' => $member->organization->slug,
            ]);

        return view('organizations.index', [
            'organizations' => $organizations,
            'url' => [
                'new' => route('organizations.new'),
                'join' => route('organizations.join'),
            ],
        ]);
    }

    public function show(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');
        $data = [];

        // get the latest cycle that is active
        // if there are no active cycles, get the latest one
        $cycle = $organization->cycles()
            ->where('is_active', true)
            ->orderBy('number', 'desc')
            ->first();

        if (! $cycle) {
            $cycle = $organization->cycles()
                ->orderBy('number', 'desc')
                ->first();
        }

        if ($cycle) {
            $data = CycleViewModel::show($cycle);
        }

        return view('organizations.show', [
            'organization' => $organization,
            'member' => $member,
            'cycle' => $cycle ? $data['cycle'] : null,
            'nextCycle' => $cycle ? $data['nextCycle'] : null,
            'previousCycle' => $cycle ? $data['previousCycle'] : null,
            'url' => [
                'cycle' => [
                    'new' => route('organizations.cycles.new', ['slug' => $organization->slug]),
                ],
            ],
        ]);
    }
}
