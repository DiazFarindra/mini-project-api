<?php

namespace App\Models;

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
            $increment = static::count();
            $value = 'BRG_' . $increment++;
            $model->kode = $value;
        });
    }

    public function item_penjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'kode_barang', 'kode');
    }
}
