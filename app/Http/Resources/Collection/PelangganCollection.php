<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\PelangganResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PelangganCollection extends ResourceCollection
{
    public static $wrap = 'pelanggan';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PelangganResource::collection($this->collection);
    }
}
