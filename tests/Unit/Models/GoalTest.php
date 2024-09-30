<?php

namespace Tests\Unit\Models;

use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GoalTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_belongs_to_a_cycle(): void
    {
        $goal = Goal::factory()->create();

        $this->assertTrue($goal->cycle()->exists());
    }

    #[Test]
    public function it_has_many_members(): void
    {
        $goal = Goal::factory()->create();
        $member = Member::factory()->create();
        $goal->members()->attach($member);

        $this->assertCount(1, $goal->members);
    }
}
