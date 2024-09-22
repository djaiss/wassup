<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\Permission;
use App\Models\Member;
use App\Models\Organization;

class JoinOrganization
{
    private Organization $organization;

    public function __construct(
        public string $name,
        public string $code,
    ) {
    }

    public function execute(): Organization
    {
        $this->join();

        return $this->organization;
    }

    private function join(): void
    {
        $this->organization = Organization::where('name', $this->name)
            ->where('code', $this->code)
            ->firstOrFail();

        $memberAlreadyExists = Member::where('user_id', auth()->user()->id)
            ->where('organization_id', $this->organization->id)
            ->exists();

        if (! $memberAlreadyExists) {
            Member::create([
                'user_id' => auth()->user()->id,
                'organization_id' => $this->organization->id,
                'permission' => Permission::Member,
            ]);
        }
    }
}
