<?php

namespace Tests\Unit\Actions;

use App\Actions\DestroyGoal;
use App\Models\Cycle;
use App\Models\Goal;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DestroyGoalTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_deletes_a_goal(): void
    {
        $goal = Goal::factory()->create();

        (new DestroyGoal(
            goal: $goal,
        ))->execute();

        $this->assertDatabaseMissing('goals', [
            'id' => $goal->id,
        ]);
    }
}
