<?php

namespace Tests\Unit\Actions;

use App\Actions\AddMemberToGoal;
use App\Models\Goal;
use App\Models\Member;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AddMemberToGoalTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_adds_a_member_to_a_goal(): void
    {
        $goal = Goal::factory()->create();
        $member = Member::factory()->create();

        $goal = (new AddMemberToGoal(
            goal: $goal,
            member: $member,
        ))->execute();

        $this->assertDatabaseHas('goal_member', [
            'goal_id' => $goal->id,
            'member_id' => $member->id,
        ]);

        $this->assertInstanceOf(
            Goal::class,
            $goal
        );
    }
}
