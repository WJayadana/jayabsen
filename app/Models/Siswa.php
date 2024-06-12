<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

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

    // public function jurusan()
    // {
    //     return $this->belongsTo(Jurusan::class)->withTrashed();
    // }

    // public function tingkat()
    // {
    //     return $this->belongsTo(Tingkat::class)->withTrashed();
    // }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan')->withTrashed();
    }

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class, 'id_tingkat')->withTrashed();
    }
}
