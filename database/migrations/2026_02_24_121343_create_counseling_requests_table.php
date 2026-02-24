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
    Schema::create('counseling_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Hubungan ke user/siswa
        $table->string('category');
        $table->enum('urgency', ['rendah', 'sedang', 'darurat']);
        $table->string('whatsapp');
        $table->text('message');
        $table->enum('status', ['pending', 'scheduled', 'completed', 'rejected'])->default('pending');
        $table->date('scheduled_date')->nullable();
        $table->time('scheduled_time')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counseling_requests');
    }
};
