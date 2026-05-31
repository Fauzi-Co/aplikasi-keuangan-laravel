<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $name = trim($data['nama']);

        $exists = Kategori::whereRaw('LOWER(name) = ?', [Str::lower($name)])->exists();
        if ($exists) {
            return response(['error' => 'kategori Sudah Ada'], 409);
        }

        Kategori::create(['name' => $name]);
        return response(['data' => 'OK'], 201);
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if (! $kategori) {
            return response(['error' => 'kategori Tidak Ada'], 404);
        }

        $kategori->delete();
        return response(['data' => 'OK'], 200);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori = Kategori::find($id);
        if (! $kategori) {
            return response(['error' => 'kategori Tidak Ada'], 404);
        }

        $name = trim($data['nama']);
        $exists = Kategori::whereRaw('LOWER(name) = ?', [Str::lower($name)])->where('id', '<>', $id)->exists();
        if ($exists) {
            return response(['error' => 'kategori Sudah Ada'], 409);
        }

        $kategori->update(['name' => $name]);
        return response(['data' => 'OK'], 200);
    }
}
