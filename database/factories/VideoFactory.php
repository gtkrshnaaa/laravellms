<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Contoh ID video YouTube
        $youtubeIds = ['dQw4w9WgXcQ', '3JZ_D3ELwOQ', 'L_LUpnjgPso', 'rTgj1HxmUbg'];

        return [
            'topic_id' => Topic::factory(),
            'title' => fake()->sentence(5),
            'youtube_url' => 'https://www.youtube.com/embed/' . fake()->randomElement($youtubeIds),
            'order' => fake()->randomDigitNotNull(),
        ];
    }
}