<?php

namespace Tests\Unit\Models;

use App\Models\Member;
use App\Models\Organization;
use App\Models\Team;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_belongs_to_an_organization(): void
    {
        $team = Team::factory()->create();

        $this->assertTrue($team->organization()->exists());
    }
}
