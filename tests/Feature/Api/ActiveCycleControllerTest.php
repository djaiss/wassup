<?php

namespace Tests\Feature\Api;

use App\Models\Cycle;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ActiveCycleControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_shows_the_current_active_cycle(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $member = $this->createMember();
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
            'number' => 13,
            'is_active' => true,
        ]);

        Sanctum::actingAs($member->user);

        $response = $this->json('GET', '/api/organizations/' . $member->organization_id . '/cycles/active');

        $response->assertStatus(200);

        $this->assertEquals(
            [
                'id' => $cycle->id,
                'object' => 'cycle',
                'number' => 13,
                'description' => $cycle->description,
                'started_at' => $cycle->started_at->timestamp,
                'ended_at' => $cycle->ended_at->timestamp,
                'is_active' => true,
                'is_public' => $cycle->is_public,
                'created_at' => 1514764800,
                'updated_at' => 1514764800,
            ],
            $response->json()['data']
        );
    }

    #[Test]
    public function it_returns_an_empty_response_if_there_is_no_active_cycle(): void
    {
        $member = $this->createMember();
        Sanctum::actingAs($member->user);

        $response = $this->json('GET', '/api/organizations/' . $member->organization_id . '/cycles/active');

        $response->assertStatus(200);
        $this->assertEmpty($response->json());
    }
}
