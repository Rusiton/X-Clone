<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'username' => fake()->unique()->name(),
            'biography' => fake()->text(300),
            'private' => fake()->numberBetween(0, 1),
            'banner_url' => 'banners/' . fake()->image('public/storage/banners', 780, 480, null, false),
            'user_id' => $user->id,
        ];
    }
}
