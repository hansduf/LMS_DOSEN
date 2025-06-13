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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('student_name');
            $table->string('student_nim')->unique();
            $table->string('student_specialization');
            $table->string('student_class');
            $table->string('student_major');
            $table->string('student_email')->unique();
            $table->string('student_phone');
            $table->string('student_photo')->nullable();
            $table->string('student_password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
}; 