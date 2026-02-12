<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('name'); // Nama Lengkap
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Data Diri Siswa
            $table->string('nis', 4)->nullable();
            $table->string('nisn', 12)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('asal_smp')->nullable();
            $table->boolean('is_mutasi')->default(false);
            $table->text('riwayat_penyakit')->nullable();
            $table->string('nama_orangtua')->nullable();
            $table->string('kontak_siswa')->nullable();
            $table->string('kontak_orangtua')->nullable();

            // Role Differentiation
            $table->enum('role', ['admin', 'siswa'])->default('siswa');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
