<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory, HasUuid;
    protected $fillable = ['topic_id', 'title', 'description', 'min_score', 'order'];
    
    public function topic() { 
        return $this->belongsTo(Topic::class); 
    }

    public function questions() {
        return $this->hasMany(QuizQuestion::class);
    }
}