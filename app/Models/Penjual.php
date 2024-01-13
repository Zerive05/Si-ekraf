<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjual extends Model
{
    use HasFactory, SoftDeletes;

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
