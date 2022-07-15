<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\PenjualanResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PenjualanCollection extends ResourceCollection
{
    public static $wrap = 'penjualan';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return new PenjualanResource($this->collection);
    }
}
