<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAttempt extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quiz_attempts';

    /**
     * The attributes that are mass assignable.
     * Ini adalah kolom yang boleh diisi saat menggunakan metode create().
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'quiz_id',
        'score',
        'passed',
    ];

    /**
     * The attributes that should be cast.
     * Memastikan tipe data yang keluar dari Eloquent konsisten.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'score' => 'integer',
        'passed' => 'boolean',
    ];

    /**
     * Mendapatkan data siswa yang melakukan percobaan ini.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Mendapatkan data kuis yang dikerjakan.
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}