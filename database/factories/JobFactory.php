<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title' => fake()->jobTitle(),
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(3),
            'salary' => fake()->randomElement(['30,000 KES', '40,000 KES', '50,000 KES', '60,000 KES', '70,000 KES', '80,000 KES', '90,000 KES', '100,000 KES']),
            'location' => fake()->city(),
            'schedule' => fake()->randomElement(['full-time', 'part-time']),
            'url' => fake()->url(),
            'featured' => false,
        ];
    }
}
