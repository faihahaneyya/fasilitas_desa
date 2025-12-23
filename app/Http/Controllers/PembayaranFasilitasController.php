<?php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranFasilitasController extends Controller
{
    public function index()
    {
        $pembayaran = PembayaranFasilitas::with('peminjaman.fasilitas')
            ->latest()
            ->paginate(10);

        return view('pages.pembayaran_fasilitas.index', compact('pembayaran'));
    }

    public function create()
    {
        $peminjaman = PeminjamanFasilitas::whereIn('status', ['approved', 'completed'])
            ->whereNotNull('total_biaya')
            ->where('total_biaya', '>', 0)
            ->get();

        return view('pages.pembayaran_fasilitas.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pinjam_id' => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'metode' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('bukti_files')) {
            $request->validate([
                'bukti_files.*' => 'file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
                'captions.*' => 'nullable|string|max:255',
            ]);
        }

        $pembayaran = PembayaranFasilitas::create($validated);

        if ($request->hasFile('bukti_files')) {
            $buktiFiles = $request->file('bukti_files');
            $captions = $request->input('captions', []);

            foreach ($buktiFiles as $index => $file) {
                if ($file->isValid()) {
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('media/pembayaran', $fileName, 'public');

                    $caption = isset($captions[$index]) ? $captions[$index] : null;

                    Media::create([
                        'ref_table' => 'pembayaran_fasilitas',
                        'ref_id' => $pembayaran->getKey(),
                        'file_name' => $path,
                        'caption' => $caption,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('pembayaran-fasilitas.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    // UBAH INI: Gunakan explicit find
    public function show($id)
    {
        $pembayaran = PembayaranFasilitas::with(['peminjaman.fasilitas', 'buktiPembayaran'])
            ->findOrFail($id);

        return view('pages.pembayaran_fasilitas.show', compact('pembayaran'));
    }

    // UBAH INI: Gunakan explicit find
    public function edit($id)
    {
        $pembayaran = PembayaranFasilitas::with('buktiPembayaran')
            ->findOrFail($id);

        $peminjaman = PeminjamanFasilitas::whereIn('status', ['approved', 'completed'])
            ->whereNotNull('total_biaya')
            ->where('total_biaya', '>', 0)
            ->get();

        return view('pages.pembayaran_fasilitas.edit', compact('pembayaran', 'peminjaman'));
    }

    // UBAH INI: Gunakan explicit find
    public function update(Request $request, $id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);

        $validated = $request->validate([
            'pinjam_id' => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'metode' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('bukti_files')) {
            $request->validate([
                'bukti_files.*' => 'file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
                'captions.*' => 'nullable|string|max:255',
            ]);
        }

        $pembayaran->update($validated);

        if ($request->hasFile('bukti_files')) {
            $buktiFiles = $request->file('bukti_files');
            $captions = $request->input('captions', []);

            $lastSortOrder = $pembayaran->buktiPembayaran()->max('sort_order') ?? -1;

            foreach ($buktiFiles as $index => $file) {
                if ($file->isValid()) {
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('media/pembayaran', $fileName, 'public');

                    $caption = isset($captions[$index]) ? $captions[$index] : null;

                    Media::create([
                        'ref_table' => 'pembayaran_fasilitas',
                        'ref_id' => $pembayaran->getKey(),
                        'file_name' => $path,
                        'caption' => $caption,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $lastSortOrder + $index + 1,
                    ]);
                }
            }
        }

        return redirect()->route('pembayaran-fasilitas.show', $pembayaran->getKey())
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    // UBAH INI: Gunakan explicit find
    public function destroy($id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);

        $mediaFiles = $pembayaran->buktiPembayaran;

        foreach ($mediaFiles as $media) {
            if (Storage::disk('public')->exists($media->file_name)) {
                Storage::disk('public')->delete($media->file_name);
            }
            $media->delete();
        }

        $pembayaran->delete();

        return redirect()->route('pembayaran-fasilitas.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }

    public function deleteBukti($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        if ($media->ref_table !== 'pembayaran_fasilitas') {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        if (Storage::disk('public')->exists($media->file_name)) {
            Storage::disk('public')->delete($media->file_name);
        }

        $media->delete();

        return response()->json(['success' => true, 'message' => 'Bukti pembayaran berhasil dihapus']);
    }

    public function downloadBukti($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        if ($media->ref_table !== 'pembayaran_fasilitas') {
            abort(403, 'Akses ditolak');
        }

        $filePath = storage_path('app/public/' . $media->file_name);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath, $media->caption ?? 'bukti-pembayaran-' . $mediaId);
    }
}
