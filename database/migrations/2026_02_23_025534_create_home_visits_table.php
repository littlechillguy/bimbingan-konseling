<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_visits', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->date('tanggal_kunjungan');
            $table->text('alamat');
            $table->text('keterangan');
            $table->timestamps(); // Ini akan membuat kolom created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_visits');
    }
};