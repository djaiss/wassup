<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateCycle;
use App\Enums\Permission;
use App\Exceptions\CycleNumberAlreadyTakenException;
use App\Exceptions\CycleNumberMustBePositiveException;
use App\Exceptions\CycleStartedAtMustBeBeforeEndedAtException;
use App\Exceptions\OrganizationMismatchException;
use App\Models\Cycle;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateCycleTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_creates_a_cycle(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $member = $this->createMember(permission: Permission::Administrator);

        $cycle = (new CreateCycle(
            user: $member->user,
            organization: $member->organization,
            number: 1,
            description: 'Cycle 1',
            startedAt: now(),
            endedAt: now()->addDays(7),
            isActive: false,
            isPublic: true,
        ))->execute();

        $this->assertDatabaseHas('cycles', [
            'id' => $cycle->id,
            'organization_id' => $member->organization->id,
            'number' => 1,
            'description' => 'Cycle 1',
            'started_at' => '2018-01-01 00:00:00',
            'ended_at' => '2018-01-08 00:00:00',
            'is_active' => 0,
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

        (new CreateCycle(
            user: $member->user,
            organization: $member->organization,
            number: 1,
            description: 'Cycle 1',
            startedAt: now(),
            endedAt: now()->addDays(7),
            isActive: false,
            isPublic: true,
        ))->execute();
    }

    #[Test]
    public function it_throws_an_exception_if_the_cycle_number_is_already_taken(): void
    {
        $this->expectException(CycleNumberAlreadyTakenException::class);

        $member = $this->createMember(permission: Permission::Administrator);
        Cycle::factory()->create([
            'organization_id' => $member->organization_id,
            'number' => 301,
        ]);

        (new CreateCycle(
            user: $member->user,
            organization: $member->organization,
            number: 301,
            description: 'Cycle 1',
            startedAt: now(),
            endedAt: now()->addDays(7),
            isActive: false,
            isPublic: true,
        ))->execute();
    }

    #[Test]
    public function it_throws_an_exception_if_the_cycle_number_is_not_a_positive_integer(): void
    {
        $this->expectException(CycleNumberMustBePositiveException::class);

        $member = $this->createMember(permission: Permission::Administrator);

        (new CreateCycle(
            user: $member->user,
            organization: $member->organization,
            number: -1,
            description: 'Cycle 1',
            startedAt: now(),
            endedAt: now()->addDays(7),
            isActive: false,
            isPublic: true,
        ))->execute();
    }

    #[Test]
    public function it_throws_an_exception_if_the_started_at_date_is_after_the_ended_at_date(): void
    {
        $this->expectException(CycleStartedAtMustBeBeforeEndedAtException::class);

        $member = $this->createMember(permission: Permission::Administrator);

        (new CreateCycle(
            user: $member->user,
            organization: $member->organization,
            number: 1,
            description: 'Cycle 1',
            startedAt: now()->addDays(7),
            endedAt: now(),
            isActive: false,
            isPublic: true,
        ))->execute();
    }
}
