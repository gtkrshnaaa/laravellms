<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, HasUuid;
    
    protected $fillable = ['name', 'description', 'thumbnail', 'course_admin_id', 'course_sub_category_id'];

    public function courseAdmin() {
        return $this->belongsTo(CourseAdmin::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(CourseSubCategory::class, 'course_sub_category_id');
    }
    
    public function topics() {
        return $this->hasMany(Topic::class)->orderBy('order');
    }

    public function lecturers() {
        return $this->belongsToMany(Lecturer::class, 'course_lecturer');
    }

    // Relasi many-to-many ke Student
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public function getAllMaterialsInOrder(): \Illuminate\Support\Collection
    {
        // Load topics with their videos, quizzes, and GDrive materials
        $this->loadMissing(['topics.videos', 'topics.quizzes', 'topics.googleDriveMaterials']);

        $materials = collect();
        foreach ($this->topics as $topic) {
            // Gabungkan semua jenis materi
            $topicMaterials = $topic->videos
                ->concat($topic->quizzes)
                ->concat($topic->googleDriveMaterials);

            // Urutkan berdasarkan kolom 'order'
            $sortedTopicMaterials = $topicMaterials->sortBy('order')->values();
            $materials = $materials->concat($sortedTopicMaterials);
        }
        return $materials;
    }

    // Accessor untuk menghitung persentase progres untuk student tertentu
    public function getProgressPercentageForStudent(Student $student): int
    {
        $allMaterials = $this->getAllMaterialsInOrder();
        $totalMaterials = $allMaterials->count();

        if ($totalMaterials === 0) {
            return 0; // Hindari pembagian dengan nol jika tidak ada materi
        }

        $completedCount = 0;
        foreach ($allMaterials as $material) {
            if ($student->completions()->where('completable_id', $material->id)
                                        ->where('completable_type', get_class($material))
                                        ->exists()) {
                $completedCount++;
            }
        }
        return (int) round(($completedCount / $totalMaterials) * 100);
    }

    public function followUpLinks()
    {
        return $this->hasMany(CourseFollowUpLink::class);
    }
}