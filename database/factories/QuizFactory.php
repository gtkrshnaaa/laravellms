<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'topic_id' => Topic::factory(),
            'title' => 'Kuis Pemahaman: ' . fake()->words(3, true),
            'description' => fake()->sentence(),
            'min_score' => 75,
            'order' => fake()->randomDigitNotNull(),
        ];
    }
}