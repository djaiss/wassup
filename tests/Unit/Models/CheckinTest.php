<?php

namespace Tests\Unit\Models;

use App\Models\Checkin;
use App\Models\Member;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CheckinTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_belongs_to_a_cycle(): void
    {
        $checkin = Checkin::factory()->create();

        $this->assertTrue($checkin->cycle()->exists());
    }

    #[Test]
    public function it_belongs_to_a_member(): void
    {
        $member = Member::factory()->create();
        $checkin = Checkin::factory()->create([
            'member_id' => $member->id,
        ]);

        $this->assertTrue($checkin->member()->exists());
    }

    #[Test]
    public function it_gets_markdown_description(): void
    {
        $checkin = Checkin::factory()->create([
            'content' => 'This is a **bold** description.',
        ]);

        $this->assertEquals('<p>This is a <strong>bold</strong> description.</p>
', $checkin->getMarkdownDescription());
    }
}
