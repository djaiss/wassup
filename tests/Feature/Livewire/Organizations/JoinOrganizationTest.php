<?php

namespace Tests\Feature\Livewire\Organizations;

use App\Livewire\Organizations\JoinOrganization;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class JoinOrganizationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function the_component_renders(): void
    {
        $user = User::factory()->create();

        $component = Livewire::actingAs($user)->test(JoinOrganization::class);
        $component->assertOk()->assertSee('Join an existing organization');

        $this->get('/organizations/join')->assertSeeLivewire(JoinOrganization::class);
    }

    #[Test]
    public function it_joins_an_organization(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create([
            'name' => 'Dunder Mifflin',
            'code' => 'DM123456789012',
        ]);

        $component = Livewire::actingAs($user)->test(JoinOrganization::class);

        $component->set('name', 'Dunder Mifflin');
        $component->set('code', 'DM123456789012');
        $component->call('store');

        $this->assertDatabaseHas('members', [
            'user_id' => $user->id,
            'organization_id' => $organization->id,
        ]);
    }

    #[Test]
    public function it_cannot_join_an_organization_with_invalid_code(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create([
            'name' => 'Dunder Mifflin',
        ]);

        $component = Livewire::actingAs($user)->test(JoinOrganization::class);

        $component->set('name', 'Dunder Mifflin');
        $component->set('code', 'DM123456789012');
        $component->call('store');

        $component->assertHasErrors('code');
    }
}
