<?php

namespace Tests\Unit\Models;

use App\Enums\Permission;
use App\Models\Member;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_has_many_organizations(): void
    {
        $user = User::factory()->create();
        Member::factory()->count(2)->create([
            'user_id' => $user->id,
        ]);

        $this->assertTrue($user->members()->exists());
    }

    #[Test]
    public function it_can_check_if_it_is_a_member_of_an_organization(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();

        Member::factory()->create([
            'user_id' => $user->id,
            'organization_id' => $organization->id,
        ]);

        $this->assertTrue($user->isMemberOf($organization));
    }

    #[Test]
    public function it_can_check_if_it_is_an_administrator_of_an_organization(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();

        Member::factory()->create([
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'permission' => Permission::Administrator,
        ]);

        $this->assertTrue($user->isAdministratorOf($organization));
    }
}
