<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Member;
use App\Models\Organization;
use Illuminate\Support\Str;

class DestroyOrganization
{
    public function __construct(
        public Organization $organization,
    ) {
    }

    public function execute(): void
    {
        $this->organization->delete();
    }
}
