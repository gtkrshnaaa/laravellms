<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFollowUpLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'label' => fake()->randomElement(['Grup Diskusi WhatsApp', 'Komunitas Discord', 'Channel Telegram']),
            'url' => 'https://chat.whatsapp.com/FAKE-GROUP-INVITE',
        ];
    }
}