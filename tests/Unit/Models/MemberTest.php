<?php

namespace Tests\Unit\Models;

use App\Models\Channel;
use App\Models\Level;
use App\Models\Member;
use App\Models\Organization;
use App\Models\Role;
use App\Models\Team;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

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
