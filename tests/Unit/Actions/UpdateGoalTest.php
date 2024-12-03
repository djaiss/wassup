<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateGoal;
use App\Models\Goal;
use App\Models\Member;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateGoalTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_updates_a_goal(): void
    {
        $goal = Goal::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $goal->cycle->organization_id,
        ]);

        $goal = (new UpdateGoal(
            goal: $goal,
            member: $member,
            title: 'New Title',
            description: 'New Description',
        ))->execute();

        $this->assertDatabaseHas('goals', [
            'id' => $goal->id,
            'cycle_id' => $goal->cycle->id,
            'member_id' => $member->id,
            'title' => 'New Title',
            'description' => 'New Description',
        ]);

        $this->assertInstanceOf(
            Goal::class,
            $goal
        );
    }
}
