<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teachers', 'teacher_id')->onDelete('cascade');
            $table->string('course_code', 6)->unique();
            $table->string('title');
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->string('class_color')->default('blue-500');
            $table->string('schedule_day');
            $table->time('start_time');
            $table->integer('sks')->default(2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}; 