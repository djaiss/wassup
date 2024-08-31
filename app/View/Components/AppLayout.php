<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Member;
use App\Models\Organization;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public function __construct(
        public ?Organization $organization = null,
        public ?Member $member = null,
    ) {
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
