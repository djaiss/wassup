<?php

namespace Tests\Unit\Models;

use App\Models\Channel;
use App\Models\Level;
use App\Models\Member;
use App\Models\Organization;
use App\Models\Role;
use App\Models\Team;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

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
