<?php

// File: database/migrations/xxxx_xx_xx_xxxxxx_create_student_certificates_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_certificates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignUuid('course_id')->constrained('courses')->onDelete('cascade');
            $table->timestamp('completed_at'); // Tanggal pasti kapan kursus selesai
            $table->string('verification_token', 60)->unique(); // Token unik untuk URL publik
            $table->timestamps();

            // Siswa hanya bisa punya satu sertifikat per kursus
            $table->unique(['student_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_certificates');
    }
};