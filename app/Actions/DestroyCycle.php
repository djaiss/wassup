<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\OrganizationMismatchException;
use App\Models\Cycle;
use App\Models\User;

class DestroyCycle
{
    public function __construct(
        public User $user,
        public Cycle $cycle,
    ) {
    }

    public function execute(): void
    {
        $this->validate();
        $this->cycle->delete();
    }

    private function validate(): void
    {
        if (! $this->user->isAdministratorOf($this->cycle->organization)) {
            throw new OrganizationMismatchException('User is not an administrator of the organization.');
        }
    }
}
