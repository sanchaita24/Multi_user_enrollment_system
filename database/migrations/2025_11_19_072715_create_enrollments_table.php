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
            $table->foreignId('student_id')
            ->constrained('students')
            ->cascadeOnDelete();

    // FK to courses table
    $table->foreignId('course_id')
        ->constrained('courses')
        ->cascadeOnDelete();
        
    $table->date('enrolled_on')->nullable();
    // Prevent duplicate enrollments
    $table->unique(['student_id', 'course_id']);

            $table->timestamps();
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