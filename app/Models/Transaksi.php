<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the user that owns the Kotakaspirasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function id_penjual(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_penjual');
    }

    public function id_pmbeli(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function id_produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
