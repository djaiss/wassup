<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateCycle;
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

        $cycle = Cycle::factory()->create();

        $cycle = (new UpdateCycle(
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
}
