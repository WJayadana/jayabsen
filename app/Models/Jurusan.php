<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Jurusan extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'id',
        'nama',
        'is_active',
        'isUse', // Tambahkan kolom ini
    ];

    protected $casts = [
        'isUse' => 'boolean', // Cast ke boolean
    ];
}
