<?php

namespace Tests\Unit\ViewModels;

use App\Http\ViewModels\CycleViewModel;
use App\Models\Cycle;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CycleViewModelTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_gets_the_detail_of_a_cycle(): void
    {
        $cycle = Cycle::factory()->create();
        $nextCycle = Cycle::factory()->create([
            'organization_id' => $cycle->organization_id,
            'number' => $cycle->number + 1,
        ]);
        $previousCycle = Cycle::factory()->create([
            'organization_id' => $cycle->organization_id,
            'number' => $cycle->number - 1,
        ]);

        $array = CycleViewModel::show(cycle: $cycle);

        $this->assertCount(3, $array);

        $this->assertEquals(
            $cycle->id,
            $array['cycle']->id
        );
        $this->assertEquals(
            $nextCycle->id,
            $array['nextCycle']->id
        );
        $this->assertEquals(
            $previousCycle->id,
            $array['previousCycle']->id
        );
    }
}
