<?php

namespace Tests\Feature\Api;

use App\Enums\Permission;
use App\Models\Cycle;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CycleControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_cycle(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $member = $this->createMember(permission: Permission::Administrator);
        Sanctum::actingAs($member->user);

        $response = $this->json('POST', '/api/organizations/' . $member->organization_id . '/cycles', [
            'description' => 'This is a description of the cycle.',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-01',
            'is_active' => true,
            'is_public' => true,
        ]);

        $response->assertStatus(201);
        $cycle = Cycle::orderBy('id', 'desc')->first();

        $this->assertEquals(
            [
                'id' => $cycle->id,
                'object' => 'cycle',
                'number' => 1,
                'description' => 'This is a description of the cycle.',
                'started_at' => 1704067200,
                'ended_at' => 1704067200,
                'is_active' => true,
                'is_public' => true,
                'created_at' => 1514764800,
                'updated_at' => 1514764800,
            ],
            $response->json()['data']
        );

        $this->assertDatabaseHas('cycles', [
            'id' => $cycle->id,
        ]);
    }

    #[Test]
    public function it_updates_a_cycle(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $member = $this->createMember(permission: Permission::Administrator);
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
            'number' => 1,
        ]);

        Sanctum::actingAs($member->user);

        $response = $this->json('PUT', '/api/organizations/' . $member->organization_id . '/cycles/' . $cycle->number, [
            'description' => 'This is a description of the cycle.',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-01',
            'is_active' => true,
            'is_public' => true,
        ]);

        $response->assertStatus(200);

        $this->assertEquals(
            [
                'id' => $cycle->id,
                'object' => 'cycle',
                'number' => 1,
                'description' => 'This is a description of the cycle.',
                'started_at' => 1704067200,
                'ended_at' => 1704067200,
                'is_active' => true,
                'is_public' => true,
                'created_at' => 1514764800,
                'updated_at' => 1514764800,
            ],
            $response->json()['data']
        );

        $this->assertDatabaseHas('cycles', [
            'id' => $cycle->id,
            'number' => 1,
        ]);
    }

    #[Test]
    public function it_deletes_a_cycle(): void
    {
        $member = $this->createMember(permission: Permission::Administrator);
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
            'number' => 1,
        ]);

        Sanctum::actingAs($member->user);

        $response = $this->json('DELETE', '/api/organizations/' . $member->organization_id . '/cycles/' . $cycle->number);

        $response->assertStatus(200);

        $this->assertEquals(
            [
                'status' => 'success',
            ],
            $response->json()
        );

        $this->assertDatabaseMissing('cycles', [
            'id' => $cycle->id,
        ]);
    }

    #[Test]
    public function it_shows_a_cycle(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $member = $this->createMember();
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
            'number' => 1,
        ]);

        Sanctum::actingAs($member->user);

        $response = $this->json('GET', '/api/organizations/' . $member->organization_id . '/cycles/' . $cycle->number);

        $response->assertStatus(200);

        $this->assertEquals(
            [
                'id' => $cycle->id,
                'object' => 'cycle',
                'number' => 1,
                'description' => $cycle->description,
                'started_at' => $cycle->started_at->timestamp,
                'ended_at' => $cycle->ended_at->timestamp,
                'is_active' => $cycle->is_active,
                'is_public' => $cycle->is_public,
                'created_at' => 1514764800,
                'updated_at' => 1514764800,
            ],
            $response->json()['data']
        );
    }

    #[Test]
    public function it_lists_all_the_cycles(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $member = $this->createMember(permission: Permission::Administrator);
        Cycle::factory()->create([
            'organization_id' => $member->organization_id,
            'number' => 1,
        ]);

        Sanctum::actingAs($member->user);

        $response = $this->json('GET', '/api/organizations/' . $member->organization_id . '/cycles');

        $response->assertStatus(200);

        $this->assertEquals(
            1,
            count($response->json()['data'])
        );
        $this->assertArrayHasKey('links', $response->json());
        $this->assertArrayHasKey('meta', $response->json());
    }
}
