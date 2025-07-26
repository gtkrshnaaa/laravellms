<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CourseAdmin extends Authenticatable
{
    use HasFactory, HasUuid;

    protected $table = 'course_admins';
    protected $guard = 'course_admin'; // Penting untuk otentikasi

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Mendefinisikan bahwa seorang CourseAdmin bisa memiliki banyak Course.
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}