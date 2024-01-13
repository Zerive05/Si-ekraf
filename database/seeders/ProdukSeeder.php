<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produks')->insert([
            "nama" => Str::random('50'),
            "deskripsi" => Str::random('100'),
            "kategori" => 'kerajinan',
            "stok" => '100',
            "hargap" => '10000',
            "hargaj" => '15000',
            "id_penjual" => '1',
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"), 
        ]);
    }
}
