<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\ItemPenjualanResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemPenjualanCollection extends ResourceCollection
{
    public static $wrap = 'item_penjualan';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ItemPenjualanResource::collection($this->collection);
    }
}
