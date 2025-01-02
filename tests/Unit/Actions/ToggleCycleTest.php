<?php

namespace Tests\Unit\Actions;

use App\Actions\ToggleCycle;
use App\Models\Cycle;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ToggleCycleTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_toggles_a_cycle(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));

        $cycle = Cycle::factory()->create([
            'is_active' => false,
        ]);

        $cycle = (new ToggleCycle(
            cycle: $cycle,
            isActive: true,
        ))->execute();

        $this->assertDatabaseHas('cycles', [
            'id' => $cycle->id,
            'is_active' => true,
            'started_at' => '2018-01-01 00:00:00',
        ]);

        $cycle = (new ToggleCycle(
            cycle: $cycle,
            isActive: false,
        ))->execute();

        $this->assertDatabaseHas('cycles', [
            'id' => $cycle->id,
            'is_active' => false,
            'started_at' => null,
        ]);

        $this->assertInstanceOf(
            Cycle::class,
            $cycle
        );
    }
}
