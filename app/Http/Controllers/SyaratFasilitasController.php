<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use App\Models\SyaratFasilitas;
use Illuminate\Http\Request;

class SyaratFasilitasController extends Controller
{
    public function index()
    {
        $syarat = SyaratFasilitas::paginate(10);
        return view('pages.syarat.index', compact('syarat'));
    }

    public function create()
    {
        // Ambil semua data fasilitas untuk ditampilkan di dropdown
        $fasilitas = FasilitasUmum::all();

        return view('pages.syarat.create', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required',
            'nama_syarat' => 'required|string|max:255',
        ]);

        SyaratFasilitas::create($request->all());
        return redirect()->route('syarat.index')->with('success', 'Syarat berhasil ditambah');
    }

    public function edit($id)
    {
        $syarat = SyaratFasilitas::findOrFail($id);
        return view('pages.syarat.edit', compact('syarat'));
    }

    public function update(Request $request, $id)
    {
        $syarat = SyaratFasilitas::findOrFail($id);
        $syarat->update($request->all());
        return redirect()->route('syarat.index')->with('success', 'Syarat berhasil diupdate');
    }

    public function destroy($id)
    {
        SyaratFasilitas::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Syarat dihapus');
    }
}