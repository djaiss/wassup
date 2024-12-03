<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateGoal;
use App\Exceptions\OrganizationMismatchException;
use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Member;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateGoalTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_creates_a_goal(): void
    {
        $cycle = Cycle::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $cycle->organization_id,
        ]);

        $goal = (new CreateGoal(
            cycle: $cycle,
            member: $member,
            title: 'Goal 1',
            description: 'Goal 1 description',
        ))->execute();

        $this->assertDatabaseHas('goals', [
            'cycle_id' => $cycle->id,
            'member_id' => $member->id,
            'title' => 'Goal 1',
            'description' => 'Goal 1 description',
        ]);

        $this->assertInstanceOf(
            Goal::class,
            $goal
        );
    }

    #[Test]
    public function it_does_not_create_a_goal_if_the_member_does_not_belong_to_the_same_organization_as_the_cycle(): void
    {
        $this->expectException(OrganizationMismatchException::class);

        $cycle = Cycle::factory()->create();
        $member = Member::factory()->create();

        (new CreateGoal(
            cycle: $cycle,
            member: $member,
            title: 'Goal 1',
            description: 'Goal 1 description',
        ))->execute();
    }
}
