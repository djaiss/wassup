<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateCheckin;
use App\Models\Checkin;
use App\Models\Member;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateCheckinTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_updates_a_checkin(): void
    {
        $checkin = Checkin::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $checkin->cycle->organization_id,
        ]);

        $checkin = (new UpdateCheckin(
            checkin: $checkin,
            member: $member,
            content: 'New Content',
        ))->execute();

        $this->assertDatabaseHas('checkins', [
            'id' => $checkin->id,
            'cycle_id' => $checkin->cycle->id,
            'member_id' => $member->id,
            'content' => 'New Content',
        ]);

        $this->assertInstanceOf(
            Checkin::class,
            $checkin
        );
    }
}
