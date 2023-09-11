<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'tagline' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image' => 'image.png',
            'learnings' => ['learn A', 'learn B', 'learn C'],
        ];
    }

    public function released(Carbon $releasedAt = null): self
    {
        return $this->state(
            fn (array $attributes) => ['released_at' => $releasedAt ?? now()]
        );
    }
}
