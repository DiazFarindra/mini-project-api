<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPenjualan extends Model
{
    use HasFactory;

    protected $table = 'item_penjualan';

    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'nota', 'id_nota');
    }
}
