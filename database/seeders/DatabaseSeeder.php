<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseAdmin;
use App\Models\CourseCategory;
use App\Models\CourseFollowUpLink;
use App\Models\CourseSubCategory;
use App\Models\GoogleDriveMaterial;
use App\Models\Lecturer;
use App\Models\QuizQuestion;
use App\Models\Student;
use App\Models\SysAdmin;
use App\Models\Topic;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\QuizOption;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat user-user dasar
        SysAdmin::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'level' => 'superadmin',
        ]);
        
        $lecturers = Lecturer::factory(5)->create();
        $students = Student::factory(20)->create();

        Student::factory()->create([
             'name' => 'Siswa Uji Coba',
             'email' => 'siswauji@example.com',
        ]);
        
        echo "User dasar berhasil dibuat.\n";

        // 2. Buat Kategori dan Sub-Kategori
        $categoriesData = [
            'Web Development' => ['Frontend', 'Backend', 'Full-Stack'],
            'Data Science' => ['Machine Learning', 'Data Analysis', 'Big Data'],
            'Mobile Development' => ['Android (Kotlin)', 'iOS (Swift)', 'Cross-Platform (Flutter)'],
            'Cyber Security' => ['Ethical Hacking', 'Network Security', 'Cryptography'],
        ];

        $subCategories = collect();
        foreach ($categoriesData as $catName => $subCatNames) {
            $category = CourseCategory::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
            ]);
            foreach ($subCatNames as $subCatName) {
                $subCategories->push(CourseSubCategory::create([
                    'course_category_id' => $category->id,
                    'name' => $subCatName,
                    'slug' => Str::slug($catName . ' ' . $subCatName),
                ]));
            }
        }
        echo "Kategori dan Sub-Kategori IT berhasil dibuat.\n";

        // 3. Buat struktur data kursus yang terkontrol
        CourseAdmin::factory(4)
            ->create()
            ->each(function ($courseAdmin) use ($lecturers, $subCategories) {
                Course::factory(2)
                    ->for($courseAdmin, 'courseAdmin')
                    ->create([
                        'course_sub_category_id' => $subCategories->random()->id
                    ])
                    ->each(function ($course) use ($lecturers) {
                        // Assign lecturer
                        $course->lecturers()->attach($lecturers->random(1)->pluck('id'));
                        
                        // === Buat Follow Up Link ===
                        CourseFollowUpLink::factory()->create(['course_id' => $course->id]);

                        Topic::factory(2)
                            ->for($course)
                            ->state(new Sequence(['order' => 1], ['order' => 2]))
                            ->create()
                            ->each(function ($topic) {
                                // Buat 3 materi berurutan: Video, GDrive, Kuis
                                Video::factory()->create(['topic_id' => $topic->id, 'order' => 1]);
                                
                                // === Buat Google Drive Material ===
                                GoogleDriveMaterial::factory()->create(['topic_id' => $topic->id, 'order' => 2]);

                                Quiz::factory()->create(['topic_id' => $topic->id, 'order' => 3])
                                    ->each(function ($quiz) {
                                        QuizQuestion::factory(1)
                                            ->for($quiz)
                                            ->create()
                                            ->each(function ($question) {
                                                QuizOption::factory()->state(['is_correct' => true])->for($question)->create();
                                                QuizOption::factory(3)->state(['is_correct' => false])->for($question)->create();
                                            });
                                    });
                            });
                    });
            });

        echo "Struktur kursus presisi berhasil dibuat.\n";

        // 4. Daftarkan siswa ke kursus secara acak
        $courses = Course::all();
        foreach($students as $student) {
            if ($courses->count() > 0) {
                 $student->courses()->attach(
                     $courses->random(rand(1, min(3, $courses->count())))->pluck('id')->toArray()
                 );
            }
        }

        echo "Siswa berhasil didaftarkan ke kursus.\n";
    }
}