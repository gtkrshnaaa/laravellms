<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoogleDriveMaterialFactory extends Factory
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
            'title' => 'Materi Tambahan: ' . fake()->words(3, true),
            'google_drive_url' => 'https://docs.google.com/document/d/1_fAKE-URL-FOR-SEEDING-PURPOSES_d/edit?usp=sharing',
            'description' => fake()->sentence(15),
            'order' => fake()->randomDigitNotNull(),
        ];
    }
}