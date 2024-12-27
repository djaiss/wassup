<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateOrganization;
use App\Enums\Permission;
use App\Exceptions\OrganizationMismatchException;
use App\Models\Organization;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateOrganizationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_updates_an_organization(): void
    {
        $member = $this->createMember(permission: Permission::Administrator);

        $organization = (new UpdateOrganization(
            user: $member->user,
            organization: $member->organization,
            name: 'Dunder Mifflin',
        ))->execute();

        $this->assertDatabaseHas('organizations', [
            'id' => $organization->id,
            'name' => 'Dunder Mifflin',
            'slug' => 'dunder-mifflin',
        ]);

        $this->assertInstanceOf(
            Organization::class,
            $organization
        );
    }

    #[Test]
    public function it_throws_an_exception_if_the_user_is_not_an_administrator_of_the_organization(): void
    {
        $member = $this->createMember(permission: Permission::Member);

        $this->expectException(OrganizationMismatchException::class);

        (new UpdateOrganization(
            user: $member->user,
            organization: $member->organization,
            name: 'Dunder Mifflin',
        ))->execute();

        $this->assertDatabaseHas('organizations', [
            'id' => $member->organization->id,
            'name' => $member->organization->name,
        ]);
    }
}
