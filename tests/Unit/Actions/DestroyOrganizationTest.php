<?php

namespace Tests\Unit\Actions;

use App\Actions\DestroyOrganization;
use App\Enums\Permission;
use App\Exceptions\OrganizationMismatchException;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DestroyOrganizationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_deletes_an_organization(): void
    {
        $member = $this->createMember(permission: Permission::Administrator);

        (new DestroyOrganization(
            user: $member->user,
            organization: $member->organization,
        ))->execute();

        $this->assertDatabaseMissing('organizations', [
            'id' => $member->organization_id,
        ]);
    }

    #[Test]
    public function it_throws_an_exception_if_the_user_is_not_a_member_of_the_organization(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();

        $this->expectException(OrganizationMismatchException::class);

        (new DestroyOrganization(
            user: $user,
            organization: $organization,
        ))->execute();

        $this->assertDatabaseHas('organizations', [
            'id' => $organization->id,
        ]);
    }

    #[Test]
    public function it_throws_an_exception_if_the_user_is_not_an_administrator_of_the_organization(): void
    {
        $member = $this->createMember(permission: Permission::Member);

        $this->expectException(OrganizationMismatchException::class);

        (new DestroyOrganization(
            user: $member->user,
            organization: $member->organization,
        ))->execute();

        $this->assertDatabaseHas('organizations', [
            'id' => $member->organization_id,
        ]);
    }
}
