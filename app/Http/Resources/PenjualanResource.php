<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PenjualanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_nota' => $this->id_nota,
            'tgl' => $this->tgl,
            'kode_pelanggan' => $this->kode_pelanggan,
            'subtotal' => $this->subtotal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'pelanggan' => new PelangganResource($this->whenLoaded('pelanggan')),
            'item_penjualan' => new ItemPenjualanResource($this->whenLoaded('item_penjualan')),
        ];
    }
}
