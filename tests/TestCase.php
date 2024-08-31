<?php

namespace Tests;

use App\Enums\Permission;
use App\Models\Member;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Create a member.
     */
    public function createMember(
        Organization $organization = null,
        Permission $permission = Permission::Member
    ): Member {
        if ($organization === null) {
            $organization = Organization::factory()->create();
        }

        $user = User::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
            'permission' => $permission->value,
        ]);

        return $member;
    }
}
