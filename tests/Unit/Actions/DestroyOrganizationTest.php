<?php

namespace Tests\Unit\Actions;

use App\Actions\DestroyOrganization;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DestroyOrganizationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_deletes_an_organization(): void
    {
        $organization = Organization::factory()->create();

        (new DestroyOrganization(
            organization: $organization,
        ))->execute();

        $this->assertDatabaseMissing('organizations', [
            'id' => $organization->id,
        ]);
    }
}
