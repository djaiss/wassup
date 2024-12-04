<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateCheckin;
use App\Exceptions\OrganizationMismatchException;
use App\Models\Checkin;
use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Member;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateCheckinTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_creates_a_checkin(): void
    {
        $cycle = Cycle::factory()->create();
        $member = Member::factory()->create([
            'organization_id' => $cycle->organization_id,
        ]);

        $checkin = (new CreateCheckin(
            cycle: $cycle,
            member: $member,
            content: 'Checkin 1',
        ))->execute();

        $this->assertDatabaseHas('checkins', [
            'cycle_id' => $cycle->id,
            'member_id' => $member->id,
            'content' => 'Checkin 1',
        ]);

        $this->assertInstanceOf(
            Checkin::class,
            $checkin
        );
    }

    #[Test]
    public function it_does_not_create_a_checkin_if_the_member_does_not_belong_to_the_same_organization_as_the_cycle(): void
    {
        $this->expectException(OrganizationMismatchException::class);

        $cycle = Cycle::factory()->create();
        $member = Member::factory()->create();

        (new CreateCheckin(
            cycle: $cycle,
            member: $member,
            content: 'Checkin 1',
        ))->execute();
    }
}
