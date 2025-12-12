<?php
// app/Http/Controllers/PembayaranFasilitasController.php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranFasilitasController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index()
    {
        $pembayaran = PembayaranFasilitas::with('peminjaman')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('pages.pembayaran_fasilitas.index', compact('pembayaran'));
    }

    // Menampilkan form tambah pembayaran
    public function create()
    {
        $peminjaman = PeminjamanFasilitas::all();
        return view('pages.pembayaran_fasilitas.create', compact('peminjaman'));
    }

    // Menyimpan pembayaran baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pinjam_id'  => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal'    => 'required|date',
            'jumlah'     => 'required|numeric|min:0',
            'metode'     => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        PembayaranFasilitas::create($validated);

        return redirect()->route('pembayaran-fasilitas.index')
            ->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    // Menampilkan detail pembayaran
    public function show($id)
    {
        $pembayaran = PembayaranFasilitas::with('peminjaman')->findOrFail($id);
        return view('pages.pembayaran_fasilitas.show', compact('pembayaran'));
    }

    // Menampilkan form edit pembayaran
    public function edit($id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);
        $peminjaman = PeminjamanFasilitas::all();

        return view('pages.pembayaran_fasilitas.edit', compact('pembayaran', 'peminjaman'));
    }

    // Mengupdate pembayaran
    public function update(Request $request, $id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);

        $validated = $request->validate([
            'pinjam_id'  => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal'    => 'required|date',
            'jumlah'     => 'required|numeric|min:0',
            'metode'     => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update($validated);

        return redirect()->route('pembayaran-fasilitas.index')
            ->with('success', 'Pembayaran berhasil diperbarui!');
    }

    // Menghapus pembayaran
    public function destroy($id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran-fasilitas.index')
            ->with('success', 'Pembayaran berhasil dihapus!');
    }

    // Menampilkan statistik pembayaran (opsional)
    public function dashboard()
    {
        $totalPembayaran  = PembayaranFasilitas::sum('jumlah');
        $jumlahTransaksi  = PembayaranFasilitas::count();
        $metodePembayaran = PembayaranFasilitas::select('metode', DB::raw('count(*) as total'))
            ->groupBy('metode')
            ->get();

        return view('pages.pembayaran_fasilitas.dashboard', compact(
            'totalPembayaran',
            'jumlahTransaksi',
            'metodePembayaran'
        ));
    }
}
