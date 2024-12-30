<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cycle>
 */
final class CycleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => Organization::factory(),
            'number' => $this->faker->randomNumber(),
            'description' => $this->faker->sentence(),
            'started_at' => $startDate = $this->faker->date(),
            'ended_at' => date('Y-m-d', strtotime($startDate . ' + 30 days')),
            'is_public' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
