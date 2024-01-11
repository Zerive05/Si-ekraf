<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiResource;

class TransaksiController extends Controller
{
    public function show($id)
    {
        $trans = Transaksi::findOrFail($id);
        return new TransaksiResource($trans);
    }

    public function create(Request $request, $id)
    {
        $prod = Produk::findOrFail($id);
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
