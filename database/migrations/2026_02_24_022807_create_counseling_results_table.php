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
    Schema::create('counseling_results', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('nama_siswa');
        $table->string('jenis_layanan'); // Contoh: Pribadi, Karir, Sosial
        $table->text('keterangan');
        $table->timestamps(); // Ini akan otomatis membuat created_at & updated_at
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
