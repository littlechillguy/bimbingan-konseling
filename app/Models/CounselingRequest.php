<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounselingRequest extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     * Ini harus sesuai dengan kolom yang kita buat di migration tadi.
     */
    protected $fillable = [
    'user_id', 
    'category', 
    'urgency', 
    'whatsapp', 
    'message', 
    'status',
    'service_type',     // Jenis layanan (Pribadi/Sosial/dll)
    'scheduled_date', 
    'scheduled_time',
    'hasil_akhir',      // Kolom baru untuk catatan konseling
];

    /**
     * Relasi: Satu permohonan konseling dimiliki oleh satu User (Siswa).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}