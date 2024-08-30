<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Organization;

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
