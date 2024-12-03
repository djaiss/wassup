<?php

namespace Tests\Unit\Models;

use App\Models\Cycle;
use App\Models\Goal;
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

    #[Test]
    public function it_has_many_goals(): void
    {
        $cycle = Cycle::factory()->create();
        Goal::factory()->count(3)->create([
            'cycle_id' => $cycle->id,
        ]);
        $this->assertTrue($cycle->goals()->exists());
        $this->assertCount(3, $cycle->goals);
    }

    #[Test]
    public function it_gets_markdown_description(): void
    {
        $cycle = Cycle::factory()->create([
            'description' => 'This is a **bold** description.',
        ]);

        $this->assertEquals('<p>This is a <strong>bold</strong> description.</p>
', $cycle->getMarkdownDescription());
    }
}
