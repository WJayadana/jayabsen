<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'id',
        'id_jurusan',
        'id_tingkat',
        'kode',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'nomor',
        'start_date',
    ];
}
