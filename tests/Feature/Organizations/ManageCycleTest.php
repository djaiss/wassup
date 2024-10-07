<?php

namespace Tests\Feature\Organizations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ManageCycleTest extends TestCase
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
}
