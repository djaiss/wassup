<?php

namespace Tests\Unit\Actions;

use App\Actions\DestroyCycle;
use App\Models\Cycle;
use App\Models\Organization;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DestroyCycleTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_deletes_a_cycle(): void
    {
        $cycle = Cycle::factory()->create();

        (new DestroyCycle(
            cycle: $cycle,
        ))->execute();

        $this->assertDatabaseMissing('cycles', [
            'id' => $cycle->id,
        ]);
    }
}
