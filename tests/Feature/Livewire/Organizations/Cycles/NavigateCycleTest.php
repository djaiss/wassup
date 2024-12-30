<?php

namespace Tests\Feature\Livewire\Organizations;

use App\Livewire\Organizations\CreateOrganization;
use App\Livewire\Organizations\Cycles\NavigateCycle;
use App\Models\Cycle;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NavigateCycleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function the_component_renders(): void
    {
        $member = $this->createMember();
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
        ]);

        $component = Livewire::actingAs($member->user)->test(NavigateCycle::class, [
            'cycle' => $cycle,
        ]);
        $component->assertOk()
            ->assertSee('Draft new cycle')
            ->assertDontSee('Next cycle')
            ->assertDontSee('Previous cycle');

        $this->get('/organizations/'.$member->organization->slug.'/cycles/'.$cycle->number)->assertSeeLivewire(NavigateCycle::class);
    }

    #[Test]
    public function the_component_renders_with_cycles(): void
    {
        $member = $this->createMember();
        $cycle = Cycle::factory()->create([
            'organization_id' => $member->organization_id,
        ]);

        Cycle::factory()->create([
            'organization_id' => $member->organization_id,
            'number' => $cycle->number + 1,
        ]);

        Cycle::factory()->create([
            'organization_id' => $member->organization_id,
            'number' => $cycle->number - 1,
        ]);

        $component = Livewire::actingAs($member->user)->test(NavigateCycle::class, [
            'cycle' => $cycle,
        ]);
        $component->assertOk()
            ->assertSee('Draft new cycle')
            ->assertSee('Next cycle')
            ->assertSee('Previous cycle');

        $this->get('/organizations/' . $member->organization->slug . '/cycles/' . $cycle->number)->assertSeeLivewire(NavigateCycle::class, [
            'cycle' => $cycle,
        ]);
    }
}
