<?php

namespace Tests\Unit\Models;

use App\Models\Goal;
use App\Models\Member;
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
    public function it_belongs_to_a_member(): void
    {
        $member = Member::factory()->create();
        $goal = Goal::factory()->create([
            'member_id' => $member->id,
        ]);

        $this->assertTrue($goal->member()->exists());
    }
}
