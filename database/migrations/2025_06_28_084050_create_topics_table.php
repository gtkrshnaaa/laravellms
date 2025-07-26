<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->foreignUuid('course_id')->constrained('courses')->onDelete('cascade'); 
            $table->string('title');
            $table->integer('order')->default(0); // Untuk pengurutan materi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};