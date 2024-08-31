<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\View\View;
use Illuminate\Http\Request;

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

        return view('organizations.show', [
            'organization' => $organization,
            'member' => $member,
        ]);
    }
}
