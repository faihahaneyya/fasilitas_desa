<?php

namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;

class PetugasFasilitasController extends Controller
{
    public function index()
    {
        $petugas = PetugasFasilitas::with(['fasilitas', 'warga'])->paginate(10);
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();
        return view('petugas.create', compact('fasilitas', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required',
            'petugas_warga_id' => 'required',
            'peran' => 'required|string',
        ]);

        PetugasFasilitas::create($request->all());
        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function destroy($id)
    {
        PetugasFasilitas::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Petugas dihapus');
    }
}