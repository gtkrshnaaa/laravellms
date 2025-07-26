<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignUuid('course_id')->constrained('courses')->onDelete('cascade'); 
            $table->timestamps(); // Akan otomatis membuat kolom created_at sebagai 'enrolled_at'

            // Menambahkan unique constraint agar satu student tidak bisa mendaftar
            // ke kursus yang sama lebih dari sekali.
            $table->unique(['student_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};