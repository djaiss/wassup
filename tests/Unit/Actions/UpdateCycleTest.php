<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateCycle;
use App\Enums\Permission;
use App\Exceptions\OrganizationMismatchException;
use App\Models\Cycle;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateCycleTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_updates_a_cycle(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $member = $this->createMember(permission: Permission::Administrator);
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization->id,
        ]);

        $cycle = (new UpdateCycle(
            user: $member->user,
            cycle: $cycle,
            number: 1,
            description: 'Cycle 1',
            startedAt: now(),
            endedAt: now()->addDays(7),
            isPublic: true,
        ))->execute();

        $this->assertDatabaseHas('cycles', [
            'id' => $cycle->id,
            'organization_id' => $cycle->organization->id,
            'number' => 1,
            'description' => 'Cycle 1',
            'started_at' => '2018-01-01 00:00:00',
            'ended_at' => '2018-01-08 00:00:00',
            'is_public' => 1,
        ]);

        $this->assertInstanceOf(
            Cycle::class,
            $cycle
        );
    }

    #[Test]
    public function it_throws_an_exception_if_the_user_is_not_an_administrator_of_the_organization(): void
    {
        $this->expectException(OrganizationMismatchException::class);

        $member = $this->createMember(permission: Permission::Member);
        $cycle = Cycle::factory()->create();

        (new UpdateCycle(
            user: $member->user,
            cycle: $cycle,
            number: 1,
            description: 'Cycle 1',
            startedAt: now(),
            endedAt: now()->addDays(7),
            isPublic: true,
        ))->execute();
    }
}
