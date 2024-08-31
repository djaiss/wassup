<?php

namespace Tests\Feature\Organizations;

use App\Models\Member;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ManageOrganizationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_sees_the_welcome_screen_if_he_is_not_part_of_an_organization_yet(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/organizations')
            ->assertStatus(200)
            ->assertSee('Welcome to your Wassup account');
    }

    #[Test]
    public function a_user_sees_all_the_organizations_he_belongs_to(): void
    {
        $member = $this->createMember();
        $organization = Organization::factory()->create([
            'name' => 'Dunder Mifflin UK',
        ]);
        Member::factory()->create([
            'organization_id' => $organization->id,
            'user_id' => $member->user->id,
        ]);

        $this->actingAs($member->user)
            ->get('/organizations')
            ->assertStatus(200)
            ->assertSee($member->organization->name)
            ->assertSee('Dunder Mifflin UK');
    }
}
