<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounselingResult extends Model
{
    use HasFactory;

    protected $table = 'counseling_results';

    protected $fillable = [
        'nama_siswa',
        'jenis_layanan',
        'keterangan',
    ];
}