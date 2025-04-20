<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tool>
 */
class ToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'link' => $this->faker->url(),
            'description' => $this->faker->sentence(12),
            'tags' => $this->faker->randomElements([
                 'api', 'web', 'backend', 'frontend', 'security', 'auth', 'laravel', 'javascript', 'tools'
            ], rand(2,5))
        ];
    }
}
