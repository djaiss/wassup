<?php

namespace Tests\Feature\Controllers;

use App\Enums\Permission;
use App\Models\Cycle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CycleControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_sees_an_empty_cycle_screen_where_there_is_no_cycle_yet(): void
    {
        $member = $this->createMember();

        $this->actingAs($member->user)
            ->get('/organizations/' . $member->organization->slug)
            ->assertStatus(200)
            ->assertSee('It\'s time to create your first cycle.');
    }

    #[Test]
    public function a_user_can_access_the_new_cycle_screen(): void
    {
        $member = $this->createMember();

        $response = $this->actingAs($member->user)
            ->get('/organizations/' . $member->organization->slug . '/cycles/new')
            ->assertStatus(200)
            ->assertSee('Draft a new cycle');

        $this->assertArrayHasKey('organization', $response);
        $this->assertArrayHasKey('member', $response);

        $this->assertEquals(
            $member->organization_id,
            $response['organization']['id']
        );
        $this->assertEquals(
            $member->id,
            $response['member']['id']
        );
    }

    #[Test]
    public function a_user_can_see_a_cycle_screen(): void
    {
        $member = $this->createMember();
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
        ]);

        $response = $this->actingAs($member->user)
            ->get('/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number)
            ->assertStatus(200)
            ->assertSee('Cycle #' . $cycle->number);

        $this->assertArrayHasKey('organization', $response);
        $this->assertArrayHasKey('member', $response);
        $this->assertArrayHasKey('cycle', $response);
        $this->assertArrayHasKey('url', $response);

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
        $this->assertEquals(
            [
                'new' => env('APP_URL') . '/organizations/' . $member->organization->slug . '/cycles/new',
                'edit' => env('APP_URL') . '/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number . '/edit',
                'delete' => env('APP_URL') . '/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number . '/delete',
            ],
            $response['url']['cycle']
        );
    }

    #[Test]
    public function a_user_can_edit_a_cycle(): void
    {
        $member = $this->createMember(permission: Permission::Administrator);
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
        ]);

        $response = $this->actingAs($member->user)
            ->get('/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number . '/edit')
            ->assertStatus(200)
            ->assertSee('Edit the cycle');

        $this->assertArrayHasKey('organization', $response);
        $this->assertArrayHasKey('member', $response);
        $this->assertArrayHasKey('cycle', $response);
        $this->assertArrayHasKey('url', $response);

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
        $this->assertEquals(
            [
                'show' => env('APP_URL') . '/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number,
                'update' => env('APP_URL') . '/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number,
            ],
            $response['url']['cycle']
        );

        $this->actingAs($member->user)
            ->put('/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number, [
                'description' => 'Updated description',
            ])
            ->assertRedirect();

        $this->actingAs($member->user)
            ->get('/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number)
            ->assertStatus(200)
            ->assertSee('Updated description');
    }

    #[Test]
    public function a_user_can_delete_a_cycle(): void
    {
        $member = $this->createMember(permission: Permission::Administrator);
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
        ]);

        $response = $this->actingAs($member->user)
            ->get('/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number . '/delete')
            ->assertStatus(200)
            ->assertSee('Delete cycle #' . $cycle->number);

        $this->assertArrayHasKey('organization', $response);
        $this->assertArrayHasKey('member', $response);
        $this->assertArrayHasKey('cycle', $response);
        $this->assertArrayHasKey('url', $response);

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
        $this->assertEquals(
            [
                'show' => env('APP_URL') . '/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number,
                'destroy' => env('APP_URL') . '/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number,
            ],
            $response['url']['cycle']
        );

        $this->actingAs($member->user)
            ->delete('/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number)
            ->assertRedirect();

        $this->actingAs($member->user)
            ->get('/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number)
            ->assertStatus(401);
    }
}
