<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use Illuminate\Http\Request;

class FasilitasUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = FasilitasUmum::latest()->paginate(10);
        return view('pages.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisOptions = [
            'Aula',
            'Lapangan',
            'Kantor Kelurahan',
            'Puskesmas',
            'Sekolah',
            'Pos Kamling',
            'Masjid',
            'Gereja',
            'Pura',
            'Vihara',
            'Balai Warga',
            'Taman',
            'Pasar',
            'Parkir Umum',
            'Lainnya'
        ];

        return view('pages.fasilitas.create', compact('jenisOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'jenis' => 'required|string|max:50',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'kapasitas' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        FasilitasUmum::create($validated);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas umum berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FasilitasUmum $fasilita)
    {
        return view('pages.fasilitas.show', compact('fasilita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FasilitasUmum $fasilita)
    {
        $jenisOptions = [
            'Aula',
            'Lapangan',
            'Kantor Kelurahan',
            'Puskesmas',
            'Sekolah',
            'Pos Kamling',
            'Masjid',
            'Gereja',
            'Pura',
            'Vihara',
            'Balai Warga',
            'Taman',
            'Pasar',
            'Parkir Umum',
            'Lainnya'
        ];

        return view('pages.fasilitas.edit', compact('fasilita', 'jenisOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FasilitasUmum $fasilita)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'jenis' => 'required|string|max:50',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'kapasitas' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $fasilita->update($validated);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas umum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FasilitasUmum $fasilita)
    {
        $fasilita->delete();

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas umum berhasil dihapus.');
    }

    /**
     * Search fasilitas
     */
    // public function search(Request $request)
    // {
    //     $search = $request->search;
    //     $fasilitas = FasilitasUmum::search($search)->paginate(10);

    //     return view('fasilitas.index', compact('fasilitas', 'search'));
    // }
}
