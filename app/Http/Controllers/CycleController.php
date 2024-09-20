<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CycleController extends Controller
{
    public function new(): View
    {
        return view('organizations.cycles.new');
    }
}
