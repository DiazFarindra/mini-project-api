<?php

namespace App\Models;

use App\Enums\JenisKelamin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'id_pelanggan',
        'nama',
        'domisili',
        'jenis_kelamin',
    ];

    protected $casts = [
        'jenis_kelamin' => JenisKelamin::class,
    ];

    protected static function boot()
    {
        parent::boot();

        // generate id_pelanggan incremented
        static::creating(function ($model) {
            $increment = static::count();
            $idPelanggan = 'PELANGGAN_' . $increment++;
            $model->id_pelanggan = $idPelanggan;
        });
    }
}
