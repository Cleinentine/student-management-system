<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('name')->unique();
        });

        $data = [
            ['id' => 1, 'logo' => 'colleges/CBEA.png', 'name' => 'Business Entrepreneurship and Accountancy'],
            ['id' => 2, 'logo' => 'colleges/CCJE.png', 'name' => 'Criminal Justice Education'],
            ['id' => 3, 'logo' => 'colleges/CFAS.png', 'name' => 'Fisheries and Aquatic Sciences'],
            ['id' => 4, 'logo' => 'colleges/CHM.png', 'name' => 'Hospitality Management'],
            ['id' => 5, 'logo' => 'colleges/CICS.png', 'name' => 'Industrial Technology'],
            ['id' => 6, 'logo' => 'colleges/CIT.png', 'name' => 'Information and Computing Sciences'],
            ['id' => 7, 'logo' => 'colleges/CTE.png', 'name' => 'Teacher Education'],
            ['id' => 8, 'logo' => 'colleges/GS.png', 'name' => 'Graduate School'],
        ];

        DB::table('colleges')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
