<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembeli extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'id_user',
        'nama',
        'email',
        'password',
        'jenisk',
        'nohp',
        'alamat',
    ];
}
