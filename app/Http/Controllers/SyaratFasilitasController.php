<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use App\Models\SyaratFasilitas;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SyaratFasilitasController extends Controller
{
    public function index()
    {
        // Load relasi media dan fasilitas agar nama fasilitas juga tampil (opsional)
        $syarat = SyaratFasilitas::with(['media', 'fasilitas'])->paginate(10);

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
        // 1. Validasi
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'nama_syarat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar_syarat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
        ]);

        // 2. Simpan Data Syarat
        $syarat = SyaratFasilitas::create([
            'fasilitas_id' => $request->fasilitas_id,
            'nama_syarat' => $request->nama_syarat,
            'deskripsi' => $request->deskripsi,
        ]);

        // 3. Logika Upload Gambar ke Tabel Media
        if ($request->hasFile('gambar_syarat')) {
            $file = $request->file('gambar_syarat');

            if ($file->isValid()) {
                // Buat Nama File
                $fileName = time() . '_syarat_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan fisik file ke folder: storage/app/public/media/syarat
                $path = $file->storeAs('media/syarat', $fileName, 'public');

                // Simpan record ke tabel media
                Media::create([
                    'ref_table' => 'syarat_fasilitas',
                    'ref_id' => $syarat->syarat_id, // ID dari syarat yang baru dibuat
                    'file_name' => $path,
                    'caption' => 'Contoh Gambar ' . $request->nama_syarat,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 0,
                ]);
            }
        }

        return redirect()->route('syarat.index')->with('success', 'Syarat fasilitas berhasil ditambahkan.');
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
        // Mengambil data syarat beserta relasi fasilitas dan media
        $syarat = SyaratFasilitas::with(['fasilitas', 'media'])->findOrFail($id);

        return view('pages.syarat.show', compact('syarat'));
    }

    public function update(Request $request, $id)
    {
        $syarat = SyaratFasilitas::findOrFail($id);

        // 1. Validasi
        $request->validate([
            'fasilitas_id' => 'required',
            'nama_syarat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar_syarat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Update Data Text
        $syarat->update([
            'fasilitas_id' => $request->fasilitas_id,
            'nama_syarat' => $request->nama_syarat,
            'deskripsi' => $request->deskripsi,
        ]);

        // 3. Logika Ganti Gambar
        if ($request->hasFile('gambar_syarat')) {
            $file = $request->file('gambar_syarat');

            // Hapus file lama jika ada
            if ($syarat->media) {
                if (Storage::disk('public')->exists($syarat->media->file_name)) {
                    Storage::disk('public')->delete($syarat->media->file_name);
                }
                // Hapus record media lama
                $syarat->media()->delete();
            }

            // Simpan file baru
            $fileName = time() . '_syarat_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('media/syarat', $fileName, 'public');

            // Buat record media baru
            Media::create([
                'ref_table' => 'syarat_fasilitas',
                'ref_id' => $syarat->syarat_id,
                'file_name' => $path,
                'caption' => 'Contoh Gambar ' . $request->nama_syarat,
                'mime_type' => $file->getMimeType(),
                'sort_order' => 0,
            ]);
        }

        return redirect()->route('syarat.index')->with('success', 'Syarat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $syarat = SyaratFasilitas::findOrFail($id);

        // Hapus file fisik jika ada sebelum menghapus data database
        if ($syarat->media && Storage::disk('public')->exists($syarat->media->file_name)) {
            Storage::disk('public')->delete($syarat->media->file_name);
            $syarat->media->delete();
        }

        $syarat->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}