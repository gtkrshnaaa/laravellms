<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable, HasUuid;

    protected $table = 'students';

    /**
     * The guard associated with the model.
     *
     * @var string
     */
    protected $guard = 'student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    /**
     * Relasi many-to-many ke Course, menandakan kursus yang diikuti.
     * (Asumsi nama pivot table adalah 'enrollments')
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    /**
     * Cek apakah seorang siswa telah menyelesaikan semua materi dalam sebuah topik.
     *
     * @param Topic $topic
     * @return bool
     */
    public function isTopicCompleted(Topic $topic): bool
    {
        // Hitung total materi (video + kuis + gdrive)
        $totalMaterials = $topic->videos()->count() + $topic->quizzes()->count() + $topic->googleDriveMaterials()->count();

        if ($totalMaterials === 0) {
            return true;
        }

        // Hitung materi yang selesai
        $completedCount = Completion::where('student_id', $this->id)
            ->where(function ($query) use ($topic) {
                $query->whereIn('completable_id', $topic->videos->pluck('id'))
                    ->where('completable_type', Video::class);
            })
            ->orWhere(function ($query) use ($topic) {
                $query->whereIn('completable_id', $topic->quizzes->pluck('id'))
                    ->where('completable_type', Quiz::class);
            })
            ->orWhere(function ($query) use ($topic) { 
                $query->whereIn('completable_id', $topic->googleDriveMaterials->pluck('id'))
                    ->where('completable_type', GoogleDriveMaterial::class);
            })
            ->count();
            
        return $completedCount >= $totalMaterials;
    }

    /**
     * Dapatkan relasi ke data materi yang telah selesai.
     */
    public function completions()
    {
        return $this->hasMany(Completion::class);
    }
}