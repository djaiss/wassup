<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateOrganization;
use App\Enums\Permission;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateOrganizationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_creates_an_organization(): void
    {
        $this->executeService();
    }

    #[Test]
    public function it_cant_create_an_organization_if_the_name_is_not_unique(): void
    {
        $this->expectException(UniqueConstraintViolationException::class);
        Organization::factory()->create([
            'slug' => 'dunder-mifflin',
        ]);

        $this->executeService();
    }

    private function executeService(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $organization = (new CreateOrganization(
            name: 'Dunder mifflin',
        ))->execute();

        $this->assertDatabaseHas('organizations', [
            'id' => $organization->id,
            'name' => 'Dunder mifflin',
            'slug' => 'dunder-mifflin',
        ]);

        $this->assertDatabaseHas('members', [
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'permission' => Permission::Administrator,
        ]);

        $this->assertInstanceOf(
            Organization::class,
            $organization
        );

        $this->assertMatchesRegularExpression('/^[A-Z1-9]{14}$/', $organization->code);
    }
}
