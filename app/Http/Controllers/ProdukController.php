<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Resources\ProdukResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProduklistResource;

class ProdukController extends Controller
{
    public function index()
    {
        $prod = Produk::with('uploader:id,nama')->get();
        return ProduklistResource::collection($prod);
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
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add image validation rules
        ]);

        $filename = $this->generateRandomString();

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->extension();

            // Store the file using the hashed filename
            $path = $request->file('file')->storeAs('gambar', $filename . '.' . $extension);

            // Save the path to the database
            $request['gambar'] = $path;
        }

        $request['gambar'] = $filename . '.' . $extension;
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

    function generateRandomString($length = 30)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
