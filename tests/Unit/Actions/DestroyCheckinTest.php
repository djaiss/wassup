<?php

namespace Tests\Unit\Actions;

use App\Actions\DestroyCheckin;
use App\Models\Checkin;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DestroyCheckinTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_deletes_a_checkin(): void
    {
        $checkin = Checkin::factory()->create();

        (new DestroyCheckin(
            checkin: $checkin,
        ))->execute();

        $this->assertDatabaseMissing('checkins', [
            'id' => $checkin->id,
        ]);
    }
}
