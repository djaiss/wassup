<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\Permission;
use App\Models\Member;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateOrganization
{
    private Organization $organization;

    public function __construct(
        public string $name,
    ) {
    }

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
            'code' => $this->generateUniqueCode(),
        ]);
    }

    private function generateUniqueCode(): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
        $length = 14;
        $code = '';

        do {
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[random_int(0, strlen($characters) - 1)];
            }
        } while (Organization::where('code', $code)->exists());

        return $code;
    }

    private function createMember(): void
    {
        Member::create([
            'user_id' => Auth::user()->id,
            'organization_id' => $this->organization->id,
            'permission' => Permission::Administrator,
        ]);
    }
}
