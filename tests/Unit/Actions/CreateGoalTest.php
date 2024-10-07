<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateGoal;
use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Organization;
use Carbon\Carbon;
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

        $goal = (new CreateGoal(
            cycle: $cycle,
            title: 'Goal 1',
            description: 'Goal 1 description',
        ))->execute();

        $this->assertDatabaseHas('goals', [
            'cycle_id' => $cycle->id,
            'title' => 'Goal 1',
            'description' => 'Goal 1 description',
        ]);

        $this->assertInstanceOf(
            Goal::class,
            $goal
        );
    }
}
