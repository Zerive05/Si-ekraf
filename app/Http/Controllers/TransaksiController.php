<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjual;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TransaksiResource;

class TransaksiController extends Controller
{
    public function show($id)
    {
        $trans = Transaksi::findOrFail($id);
        return new TransaksiResource($trans);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'jmlprod' => 'required',
        ]);

        // Assuming you want to get the first result of the query
        $request['id_penjual'] = Produk::select('id_penjual')->first()->id_penjual;
        $request['id_pembeli'] = Auth::user()->id;
        $request['id_produk'] = Produk::select('id')->first()->id;

        $trans = Transaksi::create($request->all());
        return new TransaksiResource($trans);
    }

    public function delete($id)
    {
        $trans = Transaksi::findOrFail($id);
        $trans->delete();

        return new TransaksiResource($trans);
    }
}
