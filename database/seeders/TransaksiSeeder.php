<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksis')->insert([
            "id_penjual" => "1",
            "id_pembeli" => "1",
            "id_produk" => "1",
            "jmlprod" => "2",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);

        Transaksi::factory(50)->create();

        // DB::table('transaksis')->insert([
        //     "id_penjual" => "1",
        //     "id_pembeli" => "1",
        //     "id_produk" => "1",
        //     "jmlprod" => rand('1', '100'),
        //     "created_at" => date("2005-06-15 14:00:00"),
        //     "updated_at" => date("2005-06-15 14:00:00"),
        // ]);
    }
}
