<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Testing\Fakes\Fake;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->words(3, true);
        return [
            'user_id' => User::all()->random()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => 'images/3exDt9QLEIJOtwE0tG4fYOmuCswm5sNZtE0AR6jG.png',
            'description' => fake()->sentences(5, true),
            'price' => fake()->numberBetween(10, 100),
            'duration' => fake()->words(2, true),
            'status' => 1,
            'type' => fake()->randomElement(['Full Time', 'Part Time'])
        ];
    }
}
