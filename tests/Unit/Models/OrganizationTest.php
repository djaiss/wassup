<?php

namespace Tests\Unit\Models;

use App\Models\Member;
use App\Models\Organization;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_has_many_members(): void
    {
        $organization = Organization::factory()->create();
        Member::factory()->count(2)->create([
            'organization_id' => $organization->id,
        ]);

        $this->assertTrue($organization->members()->exists());
    }
}
