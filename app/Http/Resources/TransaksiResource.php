<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_penjual' => $this->id_penjual,
            'id_pembeli' => $this->id_pembeli,
            'id_produk' => $this->id_produk,
        ];
    }
}
