<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\BarangResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BarangCollection extends ResourceCollection
{
    public static $wrap = 'barang';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return BarangResource::collection($this->collection);
    }
}
