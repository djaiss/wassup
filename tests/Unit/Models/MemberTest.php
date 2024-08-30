<?php

namespace Tests\Unit\Models;

use App\Models\Member;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MemberTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_belongs_to_an_organization(): void
    {
        $member = Member::factory()->create();

        $this->assertTrue($member->organization()->exists());
    }
}