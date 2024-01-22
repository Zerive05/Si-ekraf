<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KotaslistResource extends JsonResource
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
            'judul' => $this->judul,
            "tanggal" => $this->created_at,
            'uploader' => $this->whenLoaded('uploader'),
        ];
    }
}
