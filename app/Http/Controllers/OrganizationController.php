<?php

namespace App\Http\Controllers;

use App\Http\ViewModels\CycleViewModel;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

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

        if ($cycle) {
            $data = CycleViewModel::show($cycle);
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
