<?php

namespace Tests\Feature\Controllers;

use App\Enums\Permission;
use App\Models\Cycle;
use App\Models\Goal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GoalControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_can_see_the_goals_screen(): void
    {
        $member = $this->createMember();
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
        ]);
        $goal = Goal::factory()->create([
            'cycle_id' => $cycle->id,
            'member_id' => $member->id,
        ]);

        $response = $this->actingAs($member->user)
            ->get('/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number . '/goals')
            ->assertStatus(200)
            ->assertSee('Cycle #' . $cycle->number);

        $this->assertArrayHasKey('organization', $response);
        $this->assertArrayHasKey('member', $response);
        $this->assertArrayHasKey('cycle', $response);
        $this->assertArrayHasKey('members', $response);

        $this->assertEquals(
            $member->organization_id,
            $response['organization']['id']
        );
        $this->assertEquals(
            $member->id,
            $response['member']['id']
        );
        $this->assertEquals(
            $cycle->id,
            $response['cycle']['id']
        );
    }
}
