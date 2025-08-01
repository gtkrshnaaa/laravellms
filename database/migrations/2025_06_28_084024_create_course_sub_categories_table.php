<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_sub_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_category_id')->constrained('course_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_sub_categories');
    }
};