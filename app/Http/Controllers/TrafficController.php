<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrafficController extends Controller
{
    public function index(Request $request)
    {
        $traf =
        DB::table('transaksis')
        ->select(DB::raw('MONTH(MIN(created_at)) AS bulan'), DB::raw('COUNT(*) AS jumlah_pesanan'))
        ->whereYear('created_at', now())
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

        // Output hasil query
        // foreach ($results as $result) {
        //     echo "Tahun/Bulan: " . $result->tahun_bulan . " - Jumlah Bulanan: " . $result->jumlah_bulanan;
        // }
        // $traf =
        // DB::table('transaksis')
        // ->select(DB::raw("CONCAT(YEAR(created_at),'/',MONTH(created_at)) AS tahun_bulan"), DB::raw('COUNT(*) AS jumlah_bulanan'))
        // ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        // ->get();

        return $traf;
    }

    public function reward(Request $request)
    {
        $results = DB::table('transaksis')
        ->select('id_penjual', DB::raw('SUM(jmlprod) as total_jmlprod'))
        ->groupBy('id_penjual')
        ->orderBy('total_jmlprod', 'desc')
        ->limit(3)
            ->get();

        // Lakukan operasi atau manipulasi data tambahan jika diperlukan

        // Mengembalikan hasil sebagai response JSON
        return response()->json($results);
    }
}
