<?php

namespace Database\Factories;

use App\Models\CourseAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'course_admin_id' => CourseAdmin::factory(),
            'name' => 'Program Sertifikasi ' . fake()->words(3, true),
            'description' => fake()->paragraph(4),
            'thumbnail' => null, // Kita biarkan null agar bisa pakai placeholder di view
        ];
    }
}