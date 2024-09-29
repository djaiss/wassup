<?php

namespace App\Http\Controllers;

use App\Cache\CycleCache;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    public function new(): View
    {
        return view('organizations.new');
    }

    public function index(): View
    {
        $organizations = auth()->user()->members()
            ->with('organization')
            ->get()
            ->map(fn (Member $member): array => [
                'id' => $member->organization->id,
                'name' => $member->organization->name,
                'slug' => $member->organization->slug,
            ]);

        return view('organizations.index', [
            'organizations' => $organizations,
        ]);
    }

    public function show(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');

        // get the latest cycle that is active
        // if there are no active cycles, get the latest one
        $cycle = $organization->cycles()
            ->where('is_active', true)
            ->orderBy('number', 'desc')
            ->first();

        $data = [];
        if ($cycle) {
            $data = CycleCache::make(
                organization: $organization,
                cycle: $cycle
            )->value();
        } else {
            $cycle = $organization->cycles()
                ->orderBy('number', 'desc')
                ->first();
        }

        return view('organizations.show', [
            'organization' => $organization,
            'member' => $member,
            'cycle' => $cycle ? $data['cycle'] : null,
            'nextCycle' => $cycle ? $data['nextCycle'] : null,
            'previousCycle' => $cycle ? $data['previousCycle'] : null,
        ]);
    }
}
