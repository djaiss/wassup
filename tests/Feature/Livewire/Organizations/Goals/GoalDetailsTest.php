<?php

namespace Tests\Feature\Livewire\Organizations\Goals;

use App\Livewire\Organizations\Goals\GoalDetails;
use App\Models\Contact;
use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Member;
use App\Models\Note;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GoalDetailsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function the_component_renders(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
        ]);
        $cycle = Cycle::factory()->create([
            'organization_id' => $organization->id,
        ]);

        $component = Livewire::actingAs($user)
            ->test(GoalDetails::class, [
                'member' => $member,
                'cycle' => $cycle,
            ]);

        $component->assertOk()->assertSee('Add');

        $this->get('/organizations/' . $organization->slug . '/cycles/' . $cycle->number . '/goals')
            ->assertSeeLivewire(GoalDetails::class, [
                'member' => $member,
                'cycle' => $cycle,
            ]);
    }

    #[Test]
    public function it_shows_an_empty_state_when_there_are_no_notes(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
        ]);
        $cycle = Cycle::factory()->create([
            'organization_id' => $organization->id,
        ]);

        $component = Livewire::actingAs($user)
            ->test(GoalDetails::class, [
                'member' => $member,
                'cycle' => $cycle,
            ]);
        $component->assertSeeHtml('id="blank-state"');
    }

    #[Test]
    public function the_empty_state_is_hidden_when_there_are_goals(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
        ]);
        $cycle = Cycle::factory()->create([
            'organization_id' => $organization->id,
        ]);
        Goal::factory()->create([
            'member_id' => $member->id,
            'cycle_id' => $cycle->id,
        ]);

        $component = Livewire::actingAs($user)
            ->test(GoalDetails::class, [
                'member' => $member,
                'cycle' => $cycle,
            ]);

        $component->assertDontSeeHtml('id="blank-state"');
    }

    #[Test]
    public function it_creates_a_goal(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
        ]);
        $cycle = Cycle::factory()->create([
            'organization_id' => $organization->id,
        ]);

        $component = Livewire::actingAs($user)
            ->test(GoalDetails::class, [
                'member' => $member,
                'cycle' => $cycle,
            ]);

        $component->set('title', 'This is a goal');
        $component->call('store');

        $this->assertCount(1, Goal::all());
        $this->assertEquals('This is a goal', Goal::latest()->first()->title);
    }

    #[Test]
    public function it_cannot_create_a_goal_with_less_than_three_characters(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
        ]);
        $cycle = Cycle::factory()->create([
            'organization_id' => $organization->id,
        ]);

        $component = Livewire::actingAs($user)
            ->test(GoalDetails::class, [
                'member' => $member,
                'cycle' => $cycle,
            ]);

        $component->set('title', 'Ab');
        $component->call('store');

        $component->assertHasErrors('title');
        $this->assertCount(0, Goal::all());
    }

    #[Test]
    public function it_updates_a_goal(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
        ]);
        $cycle = Cycle::factory()->create([
            'organization_id' => $organization->id,
        ]);
        $goal = Goal::factory()->create([
            'member_id' => $member->id,
            'cycle_id' => $cycle->id,
        ]);

        $component = Livewire::actingAs($user)
            ->test(GoalDetails::class, [
                'member' => $member,
                'cycle' => $cycle,
            ]);

        $component->set('title', 'This is an updated goal');
        $component->call('update', $goal->id);

        $this->assertCount(1, Goal::all());
        $this->assertEquals('This is an updated goal', Goal::latest()->first()->title);
    }

    #[Test]
    public function it_deletes_a_goal(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
        ]);
        $cycle = Cycle::factory()->create([
            'organization_id' => $organization->id,
        ]);
        $goal = Goal::factory()->create([
            'member_id' => $member->id,
            'cycle_id' => $cycle->id,
        ]);

        $component = Livewire::actingAs($user)
            ->test(GoalDetails::class, [
                'member' => $member,
                'cycle' => $cycle,
            ]);

        $component->call('delete', $goal->id);

        $this->assertCount(0, Goal::all());
    }
}
