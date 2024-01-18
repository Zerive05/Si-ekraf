<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kotakaspirasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\KotakaspirasiResource;

class KotakaspirasiController extends Controller
{
    public function index()
    {
        $kotas = Kotakaspirasi::with('uploader:id,nama')->get();
        return KotakaspirasiResource::collection($kotas);
    }

    public function show($id)
    {
        $kotas = Kotakaspirasi::with('uploader:id,nama')->findOrFail($id);
        return new KotakaspirasiResource($kotas);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
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
        $request['user_id'] = Auth::user()->id;
        $kotas = Kotakaspirasi::create($request->all());
        return new KotakaspirasiResource($kotas->loadMissing('uploader:id,nama'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
        ]);

        $kotas = Kotakaspirasi::findOrFail($request->id);
        $kotas->update($request->all());

        return new KotakaspirasiResource($kotas->loadMissing('uploader:id,nama'));
    }

    public function delete($id)
    {
        $kotas = Kotakaspirasi::findOrFail($id);
        $kotas->delete();

        return new KotakaspirasiResource($kotas->loadMissing('uploader:id,nama'));
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
