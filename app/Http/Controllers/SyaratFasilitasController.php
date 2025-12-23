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
        // 1. Ambil data syarat yang akan diedit
        $syarat = SyaratFasilitas::findOrFail($id);

        // 2. Ambil semua data fasilitas untuk pilihan di dropdown
        $fasilitas = FasilitasUmum::all();

        // 3. Kirim kedua variabel ke view
        return view('pages.syarat.edit', compact('syarat', 'fasilitas'));
    }
    public function show($id)
    {
        // Menggunakan eager loading 'fasilitas' agar data induk tampil
        $syarat = SyaratFasilitas::with('fasilitas')->findOrFail($id);
        return view('pages.syarat.show', compact('syarat'));
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