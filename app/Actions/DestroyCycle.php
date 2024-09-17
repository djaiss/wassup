<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\Permission;
use App\Models\Cycle;
use App\Models\Member;
use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DestroyCycle
{
    public function __construct(
        public Cycle $cycle,
    ) {}

    public function execute(): void
    {
        $this->cycle->delete();
    }
}
