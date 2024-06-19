<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'id_siswa',
        'id_device',
        'tanggal',
        'masuk',
        'keluar',
        'status',
    ];

    protected function workDuration(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->masuk)->diff(Carbon::parse($this->keluar))->format('%H:%I:%S')
        );
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa')->withTrashed();
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan')->withTrashed();
    }

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class, 'id_tingkat')->withTrashed();
    }

    public function device()
    {
        return $this->belongsTo(Device::class)->withTrashed();
    }

    // public function siswa()
    // {
    //     return $this->belongsTo(Siswa::class)->withTrashed();
    // }
}
