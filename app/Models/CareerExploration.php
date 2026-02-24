<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerExploration extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * Secara default Laravel akan menganggap namanya 'career_explorations'
     */
    protected $table = 'career_explorations';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignment).
     * Kolom-kolom ini harus sesuai dengan yang ada di migration Anda.
     */
    protected $fillable = [
        'user_id',
        'hobi',
        'pelajaran_favorit',
        'work_style',
        'cita_cita_keluhan',
    ];

    /**
     * Relasi ke Model User (Siswa).
     * Memungkinkan kita mengambil data siswa dari hasil pengisian karir ini.
     * Contoh: $data->user->name;
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}