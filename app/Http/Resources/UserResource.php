<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function Laravel\Prompts\password;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'jenisk' => $this->jenisk,
            'nohp' => $this->nohp,
            'alamat' => $this->alamat,
            'role' => $this->role
        ];
    }
}
