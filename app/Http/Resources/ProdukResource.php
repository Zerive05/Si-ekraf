<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'gambar' => $this->gambar,
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'kategori' => $this->kategori,
            'stok' => $this->stok,
            'hargap' => $this->hargap,
            'hargaj' => $this->hargaj,
            'beban' => $this->beban,
            'uploader' => $this->whenLoaded('uploader'),
        ];
    }
}
