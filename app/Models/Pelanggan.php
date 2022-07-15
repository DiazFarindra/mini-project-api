<?php

namespace App\Models;

use App\Enums\JenisKelamin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $guarded = ['id'];

    protected $casts = [
        'jenis_kelamin' => JenisKelamin::class,
    ];

    protected static function boot()
    {
        parent::boot();

        // generate id_pelanggan incremented
        static::creating(function ($model) {
            $increment = static::count();
            $value = 'PELANGGAN_' . $increment++;
            $model->id_pelanggan = $value;
        });
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'kode_pelanggan', 'id_pelanggan');
    }
}
