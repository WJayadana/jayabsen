<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tingkat extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'nama',
        'is_active',
        'isUse',
    ];

    protected $casts = [
        'isUse' => 'boolean', // Cast ke boolean untuk mempermudah manipulasi
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id_tingkat');
    }
}
