<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolaborasi extends Model
{
    use HasFactory;

    /**
     * Nama tabel (jika berbeda dengan nama jamak model)
     */
    protected $table = 'kolaborasis';

    /**
     * Kolom yang boleh diisi secara massal
     */
    protected $fillable = [
        'nama',
        'logo',
        'deskripsi',
        'link',
    ];
}