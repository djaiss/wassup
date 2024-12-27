<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\OrganizationMismatchException;
use App\Models\Organization;
use App\Models\User;

class DestroyOrganization
{
    public function __construct(
        public User $user,
        public Organization $organization,
    ) {
    }

    public function execute(): void
    {
        $this->validate();
        $this->organization->delete();
    }

    private function validate(): void
    {
        if (! $this->user->isAdministratorOf($this->organization)) {
            throw new OrganizationMismatchException('User is not an administrator of the organization.');
        }
    }
}
