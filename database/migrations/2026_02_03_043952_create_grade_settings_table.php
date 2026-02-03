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
        Schema::create('grade_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->decimal('attendance_weight', 8, 2);
            $table->decimal('homework_weight', 8, 2);
            $table->decimal('quiz_weight', 8, 2);
            $table->decimal('midterm_weight', 8, 2);
            $table->decimal('finals_weight', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_settings');
    }
};
