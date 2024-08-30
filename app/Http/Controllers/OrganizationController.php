<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class OrganizationController extends Controller
{
    public function new(): View
    {
        return view('organizations.new');
    }
}
