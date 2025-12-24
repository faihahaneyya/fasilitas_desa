<?php

namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;

class PetugasFasilitasController extends Controller
{
    public function index(Request $request)
    {
        // Filter berdasarkan kolom peran dan fasilitas_id
        $filterableColumns = ['peran', 'fasilitas_id'];
        $searchableColumns = []; // Pencarian utama dilakukan via orWhereHas di Model

        $petugas = PetugasFasilitas::with(['warga', 'fasilitas'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        // Data untuk dropdown filter
        $list_fasilitas = \App\Models\FasilitasUmum::all();
        $list_peran = PetugasFasilitas::distinct()->pluck('peran');

        return view('pages.petugas.index', compact('petugas', 'list_fasilitas', 'list_peran'));
    }

    public function create()
    {
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();
        return view('pages.petugas.create', compact('fasilitas', 'warga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fasilitas_id' => 'required',
            'petugas_warga_id' => 'required',
            'peran' => 'required|string|max:100',
        ]);

        PetugasFasilitas::create($validated);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Mencari data petugas berdasarkan petugas_id (Primary Key)
        $petugas = PetugasFasilitas::findOrFail($id);

        // Tetap mengambil data fasilitas dan warga untuk pilihan dropdown
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();

        return view('pages.petugas.edit', compact('petugas', 'fasilitas', 'warga'));
    }


    public function update(Request $request, $id)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required|string|max:255',
        ], [
            // Pesan kustom jika diperlukan
            'fasilitas_id.required' => 'Fasilitas harus dipilih.',
            'petugas_warga_id.required' => 'Warga yang bertugas harus dipilih.',
            'peran.required' => 'Peran petugas harus diisi.',
        ]);

        // 2. Cari data petugas berdasarkan ID
        $petugas = PetugasFasilitas::findOrFail($id);

        // 3. Update data ke database
        $petugas->update([
            'fasilitas_id' => $request->fasilitas_id,
            'petugas_warga_id' => $request->petugas_warga_id,
            'peran' => $request->peran,
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas fasilitas berhasil diperbarui.');
    }

    public function show($id)
    {
        // Mengambil data petugas beserta relasi fasilitas dan warga
        $petugas = PetugasFasilitas::with(['fasilitas', 'warga'])->findOrFail($id);

        return view('pages.petugas.show', compact('petugas'));
    }
    public function destroy($id)
    {
        PetugasFasilitas::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Petugas dihapus');
    }
}