<?php

namespace Tests\Feature\Organizations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MemberPermissionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_member_cant_see_an_organization_he_is_not_part_of(): void
    {
        $member = $this->createMember();
        $memberFromAnotherOrganization = $this->createMember();

        $this->actingAs($member->user)
            ->get('/organizations/' . $member->organization->slug)
            ->assertStatus(200);

        $this->actingAs($member->user)
            ->get('/organizations/' . $memberFromAnotherOrganization->organization->slug)
            ->assertStatus(401);
    }
}
