<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random_int = rand(0, 1);

        $ids = [
            Post::all()->random()->id,
            Profile::all()->random()->id,
        ];

        $types = [
            'App\Models\Post',
            'App\Models\Profile',
        ];

        return [
            'user_id' => User::all()->random(),
            'reportable_id' => $ids[$random_int],
            'reportable_type' => $types[$random_int],
            'reason' => fake()->text(500),
        ];
    }
}
