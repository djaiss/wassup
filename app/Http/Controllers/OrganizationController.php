<?php

namespace App\Http\Controllers;

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
                'id' => $member->organization_id,
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

        return view('organizations.show', [
            'organization' => $organization,
            'member' => $member,
            'cycle' => $cycle,
            'url' => [
                'cycle' => [
                    'new' => route('organizations.cycles.new', ['slug' => $organization->slug]),
                    'edit' => $cycle ? route('organizations.cycles.edit', ['slug' => $organization->slug, 'cycle' => $cycle->number]) : null,
                    'delete' => $cycle ? route('organizations.cycles.delete', ['slug' => $organization->slug, 'cycle' => $cycle->number]) : null,
                ],
            ],
        ]);
    }
}
