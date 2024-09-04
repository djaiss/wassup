<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->attributes->get('organization');

        $members = $organization
            ->members()
            ->get()
            ->map(fn (Member $member): array => [
                'id' => $member->id,
                'name' => $member->user->name,
            ]);

        return view('organizations.members.index', [
            'members' => $members,
        ]);
    }
}
