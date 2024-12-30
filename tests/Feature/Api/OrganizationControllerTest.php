<?php

namespace Tests\Feature\Api;

use App\Enums\Permission;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrganizationControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_an_organization(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->json('POST', '/api/organizations', [
            'name' => 'Dunder Mifflin',
        ]);

        $response->assertStatus(201);
        $organization = Organization::orderBy('id', 'desc')->first();

        $this->assertEquals(
            [
                'id' => $organization->id,
                'object' => 'organization',
                'name' => 'Dunder Mifflin',
                'slug' => 'dunder-mifflin',
                'code' => $organization->code,
                'created_at' => 1514764800,
                'updated_at' => 1514764800,
            ],
            $response->json()['data']
        );

        $this->assertDatabaseHas('organizations', [
            'id' => $organization->id,
        ]);
    }

    #[Test]
    public function it_updates_an_organization(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $member = $this->createMember(permission: Permission::Administrator);

        Sanctum::actingAs($member->user);

        $response = $this->json('PUT', '/api/organizations/' . $member->organization_id, [
            'name' => 'Dunder Mifflin',
        ]);

        $response->assertStatus(200);

        $this->assertEquals(
            [
                'id' => $member->organization_id,
                'object' => 'organization',
                'name' => 'Dunder Mifflin',
                'slug' => 'dunder-mifflin',
                'code' => $member->organization->code,
                'created_at' => 1514764800,
                'updated_at' => 1514764800,
            ],
            $response->json()['data']
        );

        $this->assertDatabaseHas('organizations', [
            'id' => $member->organization_id,
            'name' => 'Dunder Mifflin',
        ]);
    }

    #[Test]
    public function it_cant_update_an_organization(): void
    {
        $member = $this->createMember(permission: Permission::Member);
        Sanctum::actingAs($member->user);

        $response = $this->json('PUT', '/api/organizations/' . $member->organization_id, [
            'name' => 'Dunder Mifflin',
        ]);

        $response->assertStatus(401);
    }

    #[Test]
    public function it_deletes_an_organization(): void
    {
        $member = $this->createMember(permission: Permission::Administrator);

        Sanctum::actingAs($member->user);

        $response = $this->json('DELETE', '/api/organizations/' . $member->organization_id);

        $response->assertStatus(200);

        $this->assertEquals(
            [
                'status' => 'success',
            ],
            $response->json()
        );

        $this->assertDatabaseMissing('organizations', [
            'id' => $member->organization_id,
        ]);
    }

    #[Test]
    public function it_cant_delete_an_organization(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create([
            'name' => 'Paper Company',
        ]);

        Sanctum::actingAs($user);

        $response = $this->json('DELETE', '/api/organizations/' . $organization->id);

        $response->assertStatus(401);
    }

    #[Test]
    public function it_shows_an_organization(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $member = $this->createMember(permission: Permission::Administrator);

        Sanctum::actingAs($member->user);

        $response = $this->json('GET', '/api/organizations/' . $member->organization_id);

        $response->assertStatus(200);

        $this->assertEquals(
            [
                'id' => $member->organization_id,
                'object' => 'organization',
                'name' => $member->organization->name,
                'slug' => $member->organization->slug,
                'code' => $member->organization->code,
                'created_at' => 1514764800,
                'updated_at' => 1514764800,
            ],
            $response->json()['data']
        );
    }

    #[Test]
    public function it_lists_all_the_organizations(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $organization = Organization::factory()->create([
            'name' => 'Paper Company',
        ]);
        $member = $this->createMember(permission: Permission::Administrator, organization: $organization);

        Sanctum::actingAs($member->user);

        $response = $this->json('GET', '/api/organizations');

        $response->assertStatus(200);

        $this->assertEquals(
            1,
            count($response->json()['data'])
        );
        $this->assertArrayHasKey('links', $response->json());
        $this->assertArrayHasKey('meta', $response->json());
    }
}
