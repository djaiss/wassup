<?php

namespace App\Http\Controllers;

use App\Enums\Permission;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrganizationSettingsController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');

        if ($member->permission !== Permission::Administrator->value) {
            abort(403);
        }

        return view('organizations.settings.index', [
            'organization' => $organization,
            'member' => $member,
        ]);
    }
}
