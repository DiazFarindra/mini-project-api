<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (static::count() < 1) {
                $model->kode = 'BRG_1';
                return;
            }

            $increment = substr(static::latest()->first()->kode, -1);
            $value = 'BRG_' . $increment + 1;
            $model->kode = $value;
        });
    }

    protected function nama(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_strtoupper($value),
        );
    }

    public function item_penjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'kode_barang', 'kode');
    }

    public function getRouteKeyName()
    {
        return 'kode';
    }
}
