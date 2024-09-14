<?php

namespace Tests\Unit\Models;

use App\Models\Cycle;
use App\Models\Team;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CycleTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_belongs_to_an_organization(): void
    {
        $cycle = Cycle::factory()->create();

        $this->assertTrue($cycle->organization()->exists());
    }
}
