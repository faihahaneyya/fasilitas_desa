<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    // Validasi data fasilitas
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'jenis' => 'required|string|max:50',
        'alamat' => 'required|string',
        'rt' => 'nullable|string|max:3',
        'rw' => 'nullable|string|max:3',
        'kapasitas' => 'nullable|integer|min:0',
        'deskripsi' => 'nullable|string',
    ]);

    // Validasi file upload
    if ($request->hasFile('media_files')) {
        $request->validate([
            'media_files.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'captions.*' => 'nullable|string|max:255',
        ]);
    }

    // Buat fasilitas
    $fasilitas = FasilitasUmum::create($validated);

    // Upload dan simpan file ke tabel media
    if ($request->hasFile('media_files')) {
        $mediaFiles = $request->file('media_files');
        $captions = $request->input('captions', []);

        foreach ($mediaFiles as $index => $file) {
            if ($file->isValid()) {
                // Generate nama file unik
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                // Simpan file ke storage
                $path = $file->storeAs('media/fasilitas', $fileName, 'public');

                // Ambil caption jika ada
                $caption = isset($captions[$index]) ? $captions[$index] : null;

                // Simpan ke tabel media
                \App\Models\Media::create([
                    'ref_table' => 'fasilitas_umum',
                    'ref_id' => $fasilitas->fasilitas_id,
                    'file_name' => $path,
                    'caption' => $caption,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $index, // Urutan berdasarkan index
                ]);
            }
        }
    }

    return redirect()->route('fasilitas.index')
        ->with('success', 'Fasilitas umum berhasil ditambahkan dengan foto.');
}
    /**
     * Display the specified resource.
     */
    public function show(FasilitasUmum $fasilita)
    {
        // Decode foto jika ada
        $fasilita->fotos = $fasilita->fotos ? json_decode($fasilita->fotos, true) : [];
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

        // Decode foto jika ada
        $fasilita->fotos = $fasilita->fotos ? json_decode($fasilita->fotos, true) : [];

        return view('pages.fasilitas.edit', compact('fasilita', 'jenisOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FasilitasUmum $fasilita)
{
    // Validasi data fasilitas
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'jenis' => 'required|string|max:50',
        'alamat' => 'required|string',
        'rt' => 'nullable|string|max:3',
        'rw' => 'nullable|string|max:3',
        'kapasitas' => 'nullable|integer|min:0',
        'deskripsi' => 'nullable|string',
    ]);

    // Validasi file upload tambahan
    if ($request->hasFile('media_files')) {
        $request->validate([
            'media_files.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'captions.*' => 'nullable|string|max:255',
        ]);
    }

    // Update data fasilitas
    $fasilita->update($validated);

    // Upload dan simpan file tambahan ke tabel media
    if ($request->hasFile('media_files')) {
        $mediaFiles = $request->file('media_files');
        $captions = $request->input('captions', []);

        // Hitung urutan terakhir
        $lastSortOrder = $fasilita->media()->max('sort_order') ?? -1;

        foreach ($mediaFiles as $index => $file) {
            if ($file->isValid()) {
                // Generate nama file unik
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                // Simpan file ke storage
                $path = $file->storeAs('media/fasilitas', $fileName, 'public');

                // Ambil caption jika ada
                $caption = isset($captions[$index]) ? $captions[$index] : null;

                // Simpan ke tabel media
                \App\Models\Media::create([
                    'ref_table' => 'fasilitas_umum',
                    'ref_id' => $fasilita->fasilitas_id,
                    'file_name' => $path,
                    'caption' => $caption,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $lastSortOrder + $index + 1,
                ]);
            }
        }
    }

    return redirect()->route('fasilitas.show', $fasilita->fasilitas_id)
        ->with('success', 'Fasilitas umum berhasil diperbarui.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FasilitasUmum $fasilita)
    {
        // Hapus foto dari storage jika ada
        if ($fasilita->fotos) {
            $fotos = json_decode($fasilita->fotos, true);
            foreach ($fotos as $foto) {
                if (Storage::disk('public')->exists($foto['path'])) {
                    Storage::disk('public')->delete($foto['path']);
                }
            }
        }

        $fasilita->delete();

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas umum berhasil dihapus.');
    }

    /**
     * Hapus foto tertentu dari fasilitas
     */
  /**
 * Hapus media tertentu
 */
public function deleteMedia($mediaId)
{
    $media = \App\Models\Media::findOrFail($mediaId);

    // Hapus file dari storage
    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($media->file_name)) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($media->file_name);
    }

    // Hapus dari database
    $media->delete();

    return response()->json(['success' => true]);
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
