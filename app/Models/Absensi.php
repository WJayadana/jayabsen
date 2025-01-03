<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'id_siswa',
        'id_device',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'status',
    ];
}
