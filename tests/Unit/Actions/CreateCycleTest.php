<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateCycle;
use App\Exceptions\OrganizationMismatchException;
use App\Models\Cycle;
use App\Models\Member;
use App\Models\Organization;
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

        $cycle = (new CreateCycle(
            organization: $organization = Organization::factory()->create(),
            number: 1,
            description: 'Cycle 1',
            startedAt: now(),
            endedAt: now()->addDays(7),
            isActive: false,
            isPublic: true,
        ))->execute();

        $this->assertDatabaseHas('cycles', [
            'id' => $cycle->id,
            'organization_id' => $organization->id,
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
}
