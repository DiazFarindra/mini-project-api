<?php

namespace App\Models;

use App\Enums\JenisKelamin;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

        static::creating(function ($model) {
            if (static::count() < 1) {
                $model->id_pelanggan = 'PELANGGAN_1';
                return;
            }

            $increment = substr(static::latest()->first()->id_pelanggan, -1);
            $value = 'PELANGGAN_' . $increment + 1;
            $model->id_pelanggan = $value;
        });
    }

    protected function jenisKelamin(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_strtoupper($value),
        );
    }

    protected function domisili(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_strtoupper($value),
        );
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'kode_pelanggan', 'id_pelanggan');
    }

    public function getRouteKeyName()
    {
        return 'id_pelanggan';
    }
}
