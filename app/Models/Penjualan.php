<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $increment = static::count();
            $value = 'NOTA_' . $increment++;
            $model->id_nota = $value;
        });
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'kode_pelanggan', 'id_pelanggan');
    }

    public function item_penjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'nota', 'id_nota');
    }

    public function getRouteKeyName()
    {
        return 'id_nota';
    }
}
