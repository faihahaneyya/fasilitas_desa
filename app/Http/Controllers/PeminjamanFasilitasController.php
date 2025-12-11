<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $validated = $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required|string|max:500',
            'total_biaya' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:1000',
        ]);

        // Cek ketersediaan fasilitas
        if (!PeminjamanFasilitas::isAvailable($validated['fasilitas_id'], $validated['tanggal_mulai'], $validated['tanggal_selesai'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Fasilitas sudah dipesan pada tanggal tersebut.');
        }

        $validated['status'] = 'pending';

        PeminjamanFasilitas::create($validated);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PeminjamanFasilitas $peminjaman)
    {
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
    public function update(Request $request, PeminjamanFasilitas $peminjaman)
    {
        $validated = $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required|string|max:500',
            'status' => 'required|in:pending,approved,rejected,completed,cancelled',
            'total_biaya' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:1000',
        ]);

        // Cek ketersediaan fasilitas (kecuali untuk peminjaman yang sama)
        if ($validated['status'] == 'approved' &&
            !PeminjamanFasilitas::isAvailable($validated['fasilitas_id'], $validated['tanggal_mulai'], $validated['tanggal_selesai'], $peminjaman->pinjam_id)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Fasilitas sudah dipesan pada tanggal tersebut.');
        }

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diperbarui.');
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
        if ($request->status == 'approved' &&
            !PeminjamanFasilitas::isAvailable($peminjaman->fasilitas_id, $peminjaman->tanggal_mulai, $peminjaman->tanggal_selesai, $peminjaman->pinjam_id)) {
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
}
