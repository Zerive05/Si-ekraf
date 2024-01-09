<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TransaksiResource;
use App\Models\Produk;

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
