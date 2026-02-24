<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('career_explorations', function (Blueprint $table) {
        // Menambahkan kolom career_path setelah kolom work_style
        $table->string('career_path')->after('work_style')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_explorations', function (Blueprint $table) {
            //
        });
    }
};
