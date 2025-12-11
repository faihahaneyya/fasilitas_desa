@extends('layouts.guest.app')

@section('title', 'Peminjaman Fasilitas')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-calendar-check text-success me-2"></i> Peminjaman Fasilitas
                </h4>
                <p class="text-muted mb-0">Total: {{ $peminjaman->total() }} peminjaman</p>
            </div>
            <div>
                <a href="{{ route('peminjaman.calendar') }}" class="btn btn-info me-2">
                    <i class="bi bi-calendar-week me-2"></i> Kalender
                </a>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i> Ajukan Peminjaman
                </a>
            </div>
        </div>

        <!-- Filter dan Search -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-3">
                <form action="{{ route('peminjaman.search') }}" method="GET" class="row g-2">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0"
                                placeholder="Cari nama warga, NIK, atau fasilitas..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui
                            </option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak
                            </option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Status Summary -->
        <div class="row mb-4">
            <div class="col-md-2 col-6 mb-3">
                <div class="card border-start border-warning border-4">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-0">Menunggu</h6>
                                <h5 class="fw-bold mb-0">
                                    {{ \App\Models\PeminjamanFasilitas::where('status', 'pending')->count() }}</h5>
                            </div>
                            <i class="bi bi-clock text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-3">
                <div class="card border-start border-success border-4">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-0">Disetujui</h6>
                                <h5 class="fw-bold mb-0">
                                    {{ \App\Models\PeminjamanFasilitas::where('status', 'approved')->count() }}</h5>
                            </div>
                            <i class="bi bi-check-circle text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-3">
                <div class="card border-start border-danger border-4">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-0">Ditolak</h6>
                                <h5 class="fw-bold mb-0">
                                    {{ \App\Models\PeminjamanFasilitas::where('status', 'rejected')->count() }}</h5>
                            </div>
                            <i class="bi bi-x-circle text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-3">
                <div class="card border-start border-info border-4">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-0">Selesai</h6>
                                <h5 class="fw-bold mb-0">
                                    {{ \App\Models\PeminjamanFasilitas::where('status', 'completed')->count() }}</h5>
                            </div>
                            <i class="bi bi-check2-all text-info fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-3">
                <div class="card border-start border-secondary border-4">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-0">Dibatalkan</h6>
                                <h5 class="fw-bold mb-0">
                                    {{ \App\Models\PeminjamanFasilitas::where('status', 'cancelled')->count() }}</h5>
                            </div>
                            <i class="bi bi-ban text-secondary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6 mb-3">
                <div class="card border-start border-primary border-4">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-0">Total Biaya</h6>
                                <h5 class="fw-bold mb-0">Rp
                                    {{ number_format(\App\Models\PeminjamanFasilitas::sum('total_biaya'), 0, ',', '.') }}
                                </h5>
                            </div>
                            <i class="bi bi-cash-coin text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peminjaman Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Fasilitas</th>
                                <th>Peminjam</th>
                                <th>Tanggal</th>
                                <th>Durasi</th>
                                <th>Tujuan</th>
                                <th>Biaya</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjaman as $item)
                                <tr>
                                    <td>{{ ($peminjaman->currentPage() - 1) * $peminjaman->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <strong>{{ $item->fasilitas->name }}</strong><br>
                                        <small class="text-muted">{{ $item->fasilitas->jenis }}</small>
                                    </td>
                                    <td>
                                        <strong>{{ $item->warga->nama }}</strong><br>
                                        <small class="text-muted">NIK: {{ $item->warga->no_ktp }}</small>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}<br>
                                        <small>s/d
                                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $item->durasi }} hari</span>
                                    </td>
                                    <td>
                                        <small>{{ Str::limit($item->tujuan, 50) }}</small>
                                    </td>
                                    <td>
                                        <strong>Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $item->status_color }}">
                                            {{ $item->status_label }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('peminjaman.show', $item->pinjam_id) }}"
                                                class="btn btn-sm btn-outline-info" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('peminjaman.edit', $item->pinjam_id) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if ($item->status == 'pending')
                                                <form action="{{ route('peminjaman.status', $item->pinjam_id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="btn btn-sm btn-outline-success"
                                                        title="Setujui" onclick="return confirm('Setujui peminjaman?')">
                                                        <i class="bi bi-check"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('peminjaman.status', $item->pinjam_id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Tolak" onclick="return confirm('Tolak peminjaman?')">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('peminjaman.destroy', $item->pinjam_id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Hapus data peminjaman?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-calendar-x display-6"></i>
                                            <p class="mt-3">Belum ada data peminjaman</p>
                                            <a href="{{ route('peminjaman.create') }}" class="btn btn-success mt-2">
                                                <i class="bi bi-plus-circle me-2"></i> Ajukan Peminjaman Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($peminjaman->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $peminjaman->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .badge {
            font-size: 0.75em;
            padding: 0.35em 0.65em;
        }

        .table td {
            vertical-align: middle;
        }

        .btn-sm {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
    </style>
@endsection
