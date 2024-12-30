<?php

namespace Tests\Unit\Actions;

use App\Actions\DestroyCycle;
use App\Enums\Permission;
use App\Exceptions\OrganizationMismatchException;
use App\Models\Cycle;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DestroyCycleTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_deletes_a_cycle(): void
    {
        $member = $this->createMember(permission: Permission::Administrator);
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
        ]);

        (new DestroyCycle(
            user: $member->user,
            cycle: $cycle,
        ))->execute();

        $this->assertDatabaseMissing('cycles', [
            'id' => $cycle->id,
        ]);
    }

    #[Test]
    public function it_throws_an_exception_if_the_user_is_not_an_administrator_of_the_organization(): void
    {
        $this->expectException(OrganizationMismatchException::class);

        $member = $this->createMember(permission: Permission::Member);
        $cycle = Cycle::factory()->create();

        (new DestroyCycle(
            user: $member->user,
            cycle: $cycle,
        ))->execute();
    }
}
