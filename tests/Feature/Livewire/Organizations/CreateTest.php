<?php

namespace Tests\Feature\Livewire\Organizations;

use App\Livewire\Organizations\Create;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function the_component_renders(): void
    {
        $user = User::factory()->create();

        $component = Livewire::actingAs($user)->test(Create::class);
        $component->assertOk()->assertSee('Create a new organization');

        $this->get('/organizations/new')->assertSeeLivewire(Create::class);
    }

    #[Test]
    public function it_creates_an_organization(): void
    {
        $user = User::factory()->create();

        $component = Livewire::actingAs($user)->test(Create::class);

        $component->set('name', 'Dunder Mifflin');
        $component->call('store');

        $this->assertCount(1, Organization::all());
        $this->assertEquals('Dunder Mifflin', Organization::latest()->first()->name);
    }

    #[Test]
    public function it_cannot_create_an_organization_with_less_than_three_characters(): void
    {
        $user = User::factory()->create();

        $component = Livewire::actingAs($user)->test(Create::class);

        $component->set('name', 'Ab');
        $component->call('store');

        $component->assertHasErrors('name');
        $this->assertCount(0, Organization::all());
    }
}
