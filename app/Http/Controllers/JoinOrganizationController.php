<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JoinOrganizationController extends Controller
{
    public function new(): View
    {
        return view('organizations.join');
    }
}
