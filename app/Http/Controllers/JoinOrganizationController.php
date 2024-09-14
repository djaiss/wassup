<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class JoinOrganizationController extends Controller
{
    public function new(): View
    {
        return view('organizations.join');
    }
}
