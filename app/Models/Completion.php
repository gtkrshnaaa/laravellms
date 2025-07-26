<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Completion extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'completable_id',
        'completable_type',
    ];

    /**
     * Get the parent completable model (video atau quiz).
     */
    public function completable(): MorphTo
    {
        return $this->morphTo();
    }
}