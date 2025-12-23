<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class PeminjamanFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = request('status');
        $peminjaman = PeminjamanFasilitas::with(['fasilitas', 'warga'])
            ->byStatus($status)
            ->latest()
            ->paginate(10);

        return view('pages.peminjaman.index', compact('peminjaman', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fasilitas = FasilitasUmum::whereDoesntHave('peminjaman', function ($query) {
            $query->where('status', 'approved')
                ->where('tanggal_selesai', '>=', now()->format('Y-m-d'));
        })->get();

        $warga = Warga::orderBy('nama')->get();

        return view('pages.peminjaman.create', compact('fasilitas', 'warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi (Sesuaikan nama field dengan HTML: dokumen_files)
        $request->validate([
            'fasilitas_id' => 'required',
            'warga_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'total_biaya' => 'required',
            'dokumen_files.*' => 'nullable|file|mimes:jpeg,png,jpg,pdf,docx,xlsx|max:5120'
        ]);

        // 2. Simpan Data Peminjaman Utama
        $peminjaman = PeminjamanFasilitas::create([
            'fasilitas_id' => $request->fasilitas_id,
            'warga_id' => $request->warga_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tujuan' => $request->tujuan,
            'status' => 'pending',
            'total_biaya' => $request->total_biaya,
        ]);

        // 3. Logika Upload Gambar (Gunakan nama field 'dokumen_files')
        if ($request->hasFile('dokumen_files')) {
            $files = $request->file('dokumen_files');

            // Sesuaikan nama field input deskripsi dari HTML (asumsi name="descriptions[]")
            $descriptions = $request->input('descriptions', []);

            foreach ($files as $index => $file) {
                if ($file->isValid()) {
                    // Buat Nama File Unik
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Simpan ke storage/app/public/media/peminjaman
                    // Hasil $path: "media/peminjaman/12345.jpg"
                    $path = $file->storeAs('media/peminjaman', $fileName, 'public');

                    // Simpan ke tabel media
                    Media::create([
                        'ref_table' => 'peminjaman',
                        'ref_id' => $peminjaman->pinjam_id, // Pastikan PK di model adalah pinjam_id
                        'file_name' => $path,
                        'caption' => $descriptions[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PeminjamanFasilitas $peminjaman)
    {
        // Me-load relasi fasilitas, warga, dan media agar datanya tersedia di view
        $peminjaman->load(['fasilitas', 'warga', 'media']);

        return view('pages.peminjaman.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PeminjamanFasilitas $peminjaman)
    {
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::orderBy('nama')->get();
        $statusOptions = [
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        return view('pages.peminjaman.edit', compact('peminjaman', 'fasilitas', 'warga', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $peminjaman = PeminjamanFasilitas::findOrFail($id);

        // 1. Update data utama
        $peminjaman->update($request->except(['dokumen_files', 'captions']));

        // 2. Tambahkan media baru jika ada
        if ($request->hasFile('dokumen_files')) {
            foreach ($request->file('dokumen_files') as $index => $file) {
                $path = $file->store('media/peminjaman', 'public');

                \App\Models\Media::create([
                    'ref_table' => 'peminjaman',
                    'ref_id' => $peminjaman->pinjam_id,
                    'file_name' => $path,
                    'caption' => $request->captions[$index] ?? null,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order' => $peminjaman->media()->count() + 1
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeminjamanFasilitas $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }

    /**
     * Search peminjaman
     */
    public function search(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $peminjaman = PeminjamanFasilitas::with(['fasilitas', 'warga'])
            ->search($search)
            ->byStatus($status)
            ->latest()
            ->paginate(10);

        return view('pages.peminjaman.index', compact('peminjaman', 'search', 'status'));
    }

    /**
     * Update status peminjaman
     */
    public function updateStatus(Request $request, PeminjamanFasilitas $peminjaman)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed,cancelled',
            'catatan' => 'nullable|string|max:1000',
        ]);

        // Cek ketersediaan jika status diubah ke approved
        if (
            $request->status == 'approved' &&
            !PeminjamanFasilitas::isAvailable($peminjaman->fasilitas_id, $peminjaman->tanggal_mulai, $peminjaman->tanggal_selesai, $peminjaman->pinjam_id)
        ) {
            return redirect()->back()
                ->with('error', 'Fasilitas sudah dipesan pada tanggal tersebut.');
        }

        $peminjaman->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()
            ->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    /**
     * Get calendar events for fasilitas
     */
    public function calendar($fasilitas_id = null)
    {
        $query = PeminjamanFasilitas::with(['fasilitas', 'warga'])
            ->whereIn('status', ['approved', 'completed']);

        if ($fasilitas_id) {
            $query->where('fasilitas_id', $fasilitas_id);
        }

        $events = $query->get()->map(function ($item) {
            return [
                'id' => $item->pinjam_id,
                'title' => $item->fasilitas->name . ' - ' . $item->warga->nama,
                'start' => $item->tanggal_mulai,
                'end' => Carbon::parse($item->tanggal_selesai)->addDay()->format('Y-m-d'),
                'color' => $item->status == 'completed' ? '#6c757d' : '#198754',
                'extendedProps' => [
                    'status' => $item->status,
                    'tujuan' => $item->tujuan,
                ]
            ];
        });

        $fasilitas = FasilitasUmum::all();

        return view('peminjaman.calendar', compact('events', 'fasilitas', 'fasilitas_id'));
    }

    public function destroyMedia($id)
    {
        $media = Media::findOrFail($id);

        // 1. Hapus file fisik dari storage
        if (Storage::disk('public')->exists($media->file_name)) {
            Storage::disk('public')->delete($media->file_name);
        }

        // 2. Hapus data dari database
        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil dihapus.'
        ]);
    }
}
