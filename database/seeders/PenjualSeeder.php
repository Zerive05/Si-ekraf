<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenjualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penjuals')->insert([
            "id" => "1",
            "nama" => "su",
            "email" => "solo@gmail.com",
            "password" => bcrypt('12345678'),
            "jenisk" => "pria",
            "nohp" => "8516286436",
            "alamat" => "ngendi bae",
            "role" => "penjual",
            "saldo" => "0",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);
    }
}
