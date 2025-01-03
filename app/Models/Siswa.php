<?php

namespace App\Models;

use App\Models\Jurusan;
use App\Models\Tingkat;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
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

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class, 'id_tingkat');
    }
}
