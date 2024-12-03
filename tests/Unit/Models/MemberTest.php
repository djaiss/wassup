<?php

namespace Tests\Unit\Models;

use App\Models\Goal;
use App\Models\Member;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MemberTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_belongs_to_a_user(): void
    {
        $member = Member::factory()->create();

        $this->assertTrue($member->user()->exists());
    }

    #[Test]
    public function it_belongs_to_an_organization(): void
    {
        $member = Member::factory()->create();

        $this->assertTrue($member->organization()->exists());
    }

    #[Test]
    public function it_has_many_goals(): void
    {
        $member = Member::factory()->create();
        Goal::factory()->create([
            'member_id' => $member->id,
        ]);

        $this->assertCount(1, $member->goals);
    }
}
