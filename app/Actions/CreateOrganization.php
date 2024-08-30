<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Member;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;

class CreateOrganization
{
    private Organization $organization;

    public function __construct(
        public string $name,
    ) {}

    public function execute(): Organization
    {
        $this->create();
        $this->createMember();

        return $this->organization;
    }

    private function create(): void
    {
        $this->organization = Organization::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);
    }

    private function createMember(): void
    {
        Member::create([
            'user_id' => auth()->user()->id,
            'organization_id' => $this->organization->id,
        ]);
    }
}
