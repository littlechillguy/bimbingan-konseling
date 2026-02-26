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
    Schema::create('counseling_results', function (Blueprint $table) {
        $table->id();
        $table->string('nama_siswa');
        $table->string('jenis_layanan');
        $table->text('keterangan');
        $table->timestamps(); // Ini akan membuat created_at dan updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counseling_results');
    }
};
