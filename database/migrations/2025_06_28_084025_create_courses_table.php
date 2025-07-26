<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->foreignUuid('course_admin_id')->constrained('course_admins')->onDelete('cascade'); 
            $table->foreignUuid('course_sub_category_id')->nullable()->constrained('course_sub_categories')->onDelete('set null'); 
            $table->string('name');
            $table->text('description');
            $table->string('thumbnail')->nullable();
            // Kolom lain bisa ditambahkan nanti, seperti thumbnail, harga, dll.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};