<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\OrganizationMismatchException;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Str;

class UpdateOrganization
{
    public function __construct(
        public User $user,
        public Organization $organization,
        public string $name,
    ) {
    }

    public function execute(): Organization
    {
        $this->validate();
        $this->update();

        return $this->organization;
    }

    private function validate(): void
    {
        if (! $this->user->isAdministratorOf($this->organization)) {
            throw new OrganizationMismatchException('User is not an administrator of the organization.');
        }
    }

    private function update(): void
    {
        $this->organization->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);
    }
}
