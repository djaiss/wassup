<?php

namespace Tests\Unit\ViewModels;

use App\Http\ViewModels\GoalViewModel;
use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Member;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GoalViewModelTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_gets_all_the_goals_of_a_member_within_a_cycle(): void
    {
        $member = Member::factory()->create();
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
        ]);

        Goal::factory()->count(3)->create([
            'member_id' => $member->id,
            'cycle_id' => $cycle->id,
        ]);

        $collection = GoalViewModel::index(
            cycle: $cycle,
            member: $member
        );

        $this->assertCount(3, $collection);
    }

    #[Test]
    public function it_gets_the_goals_of_a_member_in_a_cycle(): void
    {
        $member = Member::factory()->create();
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
        ]);
        $goal = Goal::factory()->create([
            'member_id' => $member->id,
            'cycle_id' => $cycle->id,
            'title' => 'My goal',
            'description' => 'My description',
        ]);

        $array = GoalViewModel::goal($goal);

        $this->assertCount(3, $array);

        $this->assertEquals(
            [
                'id' => $cycle->id,
                'title' => 'My goal',
                'description' => 'My description',
            ],
            $array
        );
    }
}
