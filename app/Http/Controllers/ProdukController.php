<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProdukResource;

class ProdukController extends Controller
{
    public function index()
    {
        $prod = Produk::with('uploader:id,nama')->get();
        return ProdukResource::collection($prod);
    }

    public function show($id)
    {
        $prod = Produk::with('uploader:id,nama')->findOrFail($id);
        return new ProdukResource($prod);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
            'hargap' => 'required',
            'hargaj' => 'required',
        ]);

        $request['id_penjual'] = Auth::user()->id;
        $prod = Produk::create($request->all());
        return new ProdukResource($prod->loadMissing('uploader:id,nama'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'hargap' => 'requied',
            'hargaj' => 'required',
            'beban' => 'required',
        ]);

        $prod = Produk::findOrFail($request->id);
        $prod->update($request->all());

        return new ProdukResource($prod->loadMissing('uploader:id,nama'));
    }

    public function delete($id)
    {
        $prod = Produk::findOrFail($id);
        $prod->delete();

        return new ProdukResource($prod->loadMissing('uploader:id,nama'));
    }
}
