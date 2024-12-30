<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Cycle;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Checkin>
 */
final class CheckinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cycle_id' => Cycle::factory(),
            'member_id' => Member::factory(),
            'content' => $this->faker->sentence(),
        ];
    }
}
