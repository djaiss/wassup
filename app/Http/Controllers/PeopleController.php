<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PeopleController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');

        $members = $organization
            ->members()
            ->with('user')
            ->get()
            ->map(fn (Member $member): array => [
                'id' => $member->id,
                'name' => $member->user->name,
                'avatar' => $member->user->profile_photo_url,
            ]);

        return view('organizations.people.index', [
            'organization' => $organization,
            'member' => $member,
            'members' => $members,
        ]);
    }
}
