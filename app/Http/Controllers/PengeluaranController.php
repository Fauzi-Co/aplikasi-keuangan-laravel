<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    public function index()
    {
        $items = Pengeluaran::orderBy('tgl', 'desc')->get(['id','nama','kategori_id','tgl','created_at']);
        return response(['data' => $items], 200);
    }

    public function filterByDate($tahun = null, $tanggal = null, $bulan = null)
    {
        $query = Pengeluaran::query();
        if ($tahun && $tahun !== '0') $query->whereYear('tgl', $tahun);
        if ($bulan && $bulan !== '0') $query->whereMonth('tgl', $bulan);
        if ($tanggal && $tanggal !== '0') $query->whereDay('tgl', $tanggal);
        $items = $query->orderBy('tgl','desc')->get(['id','nama','kategori_id','tgl','created_at']);
        return response(['data' => $items], 200);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kategori_id' => 'nullable|integer|exists:kategori,id',
            'tgl' => 'nullable|date',
        ]);
        if ($v->fails()) return response(['error' => $v->errors()->first()], 422);

        Pengeluaran::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'tgl' => $request->tgl,
        ]);

        return response(['data' => 'OK'], 201);
    }

    public function destroy($id)
    {
        $item = Pengeluaran::find($id);
        if (! $item) return response(['error' => 'Pengeluaran Tidak Ada'], 404);
        $item->delete();
        return response(['data' => 'OK'], 200);
    }

    public function update(Request $request, $id)
    {
        $item = Pengeluaran::find($id);
        if (! $item) return response(['error' => 'Pengeluaran Tidak Ada'], 404);

        $v = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kategori_id' => 'nullable|integer|exists:kategori,id',
            'tgl' => 'nullable|date',
        ]);
        if ($v->fails()) return response(['error' => $v->errors()->first()], 422);

        $item->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'tgl' => $request->tgl,
        ]);

        return response(['data' => 'OK'], 200);
    }
}
