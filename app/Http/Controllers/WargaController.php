<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warga = Warga::latest()->paginate(10);
        return view('pages.warga.index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'];

        $pekerjaan = [
            'PNS', 'TNI', 'POLRI', 'Pegawai Swasta', 'Wiraswasta',
            'Petani', 'Nelayan', 'Buruh', 'Pelajar/Mahasiswa',
            'Ibu Rumah Tangga', 'Pensiunan', 'Lainnya'
        ];

        return view('pages.warga.create', compact('agama', 'pekerjaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|digits:16|unique:warga,no_ktp',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:50',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warga $warga)
    {
        return view('pages.warga.show', compact('warga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warga $warga)
    {
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'];

        $pekerjaan = [
            'PNS', 'TNI', 'POLRI', 'Pegawai Swasta', 'Wiraswasta',
            'Petani', 'Nelayan', 'Buruh', 'Pelajar/Mahasiswa',
            'Ibu Rumah Tangga', 'Pensiunan', 'Lainnya'
        ];

        return view('pages.warga.edit', compact('warga', 'agama', 'pekerjaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|digits:16|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:50',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100',
        ]);

        $warga->update($validated);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}
