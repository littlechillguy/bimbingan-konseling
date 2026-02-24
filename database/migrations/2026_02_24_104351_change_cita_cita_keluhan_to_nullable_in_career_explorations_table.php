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
        // Mengubah kolom menjadi nullable
        $table->text('cita_cita_keluhan')->nullable()->change();
    });
}

public function down()
{
    Schema::table('career_explorations', function (Blueprint $table) {
        $table->text('cita_cita_keluhan')->nullable(false)->change();
    });
}
};
