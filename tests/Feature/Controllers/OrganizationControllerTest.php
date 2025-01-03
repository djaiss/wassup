<?php

namespace Tests\Feature\Controllers;

use App\Enums\Permission;
use App\Models\Cycle;
use App\Models\Member;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrganizationControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_sees_an_empty_screen_where_there_is_no_organization_yet(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/organizations')
            ->assertStatus(200)
            ->assertSee('blank-state')
            ->assertSee('Welcome to your Wassup account!');

        $this->assertArrayHasKey('organizations', $response->original);
        $this->assertArrayHasKey('url', $response->original);
        $this->assertArrayHasKey('new', $response->original['url']);
        $this->assertArrayHasKey('join', $response->original['url']);

        $this->assertEquals(
            0,
            count($response->original['organizations'])
        );
        $this->assertEquals(
            env('APP_URL') . '/organizations/new',
            $response->original['url']['new']
        );

        $this->assertEquals(
            env('APP_URL') . '/organizations/join',
            $response->original['url']['join']
        );
    }

    #[Test]
    public function a_user_sees_the_organizations_he_belongs_to(): void
    {
        $user = User::factory()->create();
        $nike = Organization::factory()->create([
            'name' => 'Nike',
        ]);
        Member::factory()->create([
            'organization_id' => $nike->id,
            'user_id' => $user->id,
            'permission' => Permission::Member->value,
        ]);

        $adidas = Organization::factory()->create([
            'name' => 'Adidas',
        ]);
        Member::factory()->create([
            'organization_id' => $adidas->id,
            'user_id' => $user->id,
            'permission' => Permission::Member->value,
        ]);

        $response = $this->actingAs($user)
            ->get('/organizations')
            ->assertStatus(200)
            ->assertSee('Nike')
            ->assertSee('Adidas');

        $this->assertEquals(
            2,
            count($response->original['organizations'])
        );
        $this->assertEquals(
            [
                'id' => $nike->id,
                'name' => 'Nike',
                'slug' => $nike->slug,
            ],
            $response->original['organizations'][0]
        );
    }

    #[Test]
    public function a_user_can_access_the_new_organization_screen(): void
    {
        $member = $this->createMember();

        $this->actingAs($member->user)
            ->get('/organizations/new')
            ->assertStatus(200)
            ->assertSee('Create a new organization');
    }

    #[Test]
    public function a_user_can_see_the_default_active_cycle_screen(): void
    {
        $member = $this->createMember();
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
            'is_active' => true,
        ]);

        $response = $this->actingAs($member->user)
            ->get('/organizations/' . $member->organization->slug)
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
}
