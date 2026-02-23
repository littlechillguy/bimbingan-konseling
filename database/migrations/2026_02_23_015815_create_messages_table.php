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
        Schema::create('messages', function (Blueprint $blueprint) {
            $blueprint->bigIncrements('id');
            
            // Menggunakan foreignId agar otomatis terhubung dengan tabel users
            // constrained() memastikan ID user tersebut memang ada di database
            // cascadeOnDelete() menghapus pesan jika user dihapus
            $blueprint->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            
            // Nullable karena pesan anonim ditujukan ke sistem/seluruh Guru BK
            $blueprint->unsignedBigInteger('receiver_id')->nullable();
            
            $blueprint->text('message');
            $blueprint->boolean('is_anonymous')->default(true);
            $blueprint->boolean('is_read')->default(false);
            
            // Menghasilkan created_at dan updated_at secara otomatis
            $blueprint->timestamps(); 

            // Tambahkan index jika pencarian pesan sering dilakukan (opsional)
            $blueprint->index('sender_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};