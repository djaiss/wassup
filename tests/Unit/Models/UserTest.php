<?php

namespace Tests\Unit\Models;

use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_has_many_organizations(): void
    {
        $user = User::factory()->create();
        Member::factory()->count(2)->create([
            'user_id' => $user->id,
        ]);

        $this->assertTrue($user->members()->exists());
    }
}
