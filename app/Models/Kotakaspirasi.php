<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kotakaspirasi extends Model
{
    use HasFactory, SoftDeletes;

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'gambar', 'judul', 'isi', 'user_id'
    ];

    /**
     * Get the user that owns the Kotakaspirasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
