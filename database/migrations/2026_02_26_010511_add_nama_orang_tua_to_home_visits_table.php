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
    Schema::table('home_visits', function (Blueprint $table) {
        // Menambahkan kolom nama_orang_tua setelah kolom nama_siswa
        $table->string('nama_orang_tua')->after('nama_siswa')->nullable();
    });
}

public function down()
{
    Schema::table('home_visits', function (Blueprint $table) {
        $table->dropColumn('nama_orang_tua');
    });
}
};
