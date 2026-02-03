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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('subject_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('material')->nullable();
            $table->date('deadline')->nullable();
            $table->string('status');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
