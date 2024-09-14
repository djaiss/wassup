<?php

namespace Tests\Unit\Actions;

use App\Actions\JoinOrganization;
use App\Enums\Permission;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class JoinOrganizationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_joins_an_organization(): void
    {
        $this->executeService('Dunder mifflin', 'dunder-mifflin');
    }

    #[Test]
    public function it_fails_if_the_code_doesnt_belong_to_the_organization(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->executeService('Dunder mifflin', 'this is a wrong code');
    }

    private function executeService(string $name, string $code): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $organization = Organization::factory()->create([
            'name' => 'Dunder mifflin',
            'code' => 'dunder-mifflin',
        ]);

        $organization = (new JoinOrganization(
            name: $name,
            code: $code,
        ))->execute();

        $this->assertDatabaseHas('members', [
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'permission' => Permission::Member,
        ]);

        $this->assertInstanceOf(
            Organization::class,
            $organization
        );
    }
}
