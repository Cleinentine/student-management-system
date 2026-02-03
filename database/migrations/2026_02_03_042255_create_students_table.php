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
            $table->id();
            $table->foreignId('program_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('section_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('student_number')->unique();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('home_address');
            $table->string('avatar')->nullable();
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
