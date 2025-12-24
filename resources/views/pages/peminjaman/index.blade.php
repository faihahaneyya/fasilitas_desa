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
                <a href="{{ route('peminjaman.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i> Ajukan Peminjaman
                </a>
            </div>
        </div>

        <!-- form fitur -->
        <form method="GET" action="{{ route('peminjaman.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-2">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        @foreach(['pending', 'approved', 'rejected', 'completed', 'cancelled'] as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Cari warga, fasilitas, atau tujuan...">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        @if(request('search') || request('status'))
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
        <!-- Status Summary -->
        <div class="row mb-4">
            <div class="col-md-2 col-6 mb-3">
                <div class="card border-start border-warning border-4">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-0">Menunggu</h6>
                                <h5 class="fw-bold mb-0">
                                    {{ \App\Models\PeminjamanFasilitas::where('status', 'pending')->count() }}
                                </h5>
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
                                    {{ \App\Models\PeminjamanFasilitas::where('status', 'approved')->count() }}
                                </h5>
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
                                    {{ \App\Models\PeminjamanFasilitas::where('status', 'rejected')->count() }}
                                </h5>
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
                                    {{ \App\Models\PeminjamanFasilitas::where('status', 'completed')->count() }}
                                </h5>
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
                                    {{ \App\Models\PeminjamanFasilitas::where('status', 'cancelled')->count() }}
                                </h5>
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

        <!-- Peminjaman dalam Card Grid -->
        <div class="row">
            @forelse ($peminjaman as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <!-- Card Header -->
                        <div class="card-header bg-white border-bottom-0 pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="fw-bold mb-1">{{ $item->fasilitas->name }}</h6>
                                <span class="badge bg-{{ $item->status_color }}">
                                    {{ $item->status_label }}
                                </span>
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-person me-1"></i> {{ $item->warga->nama }}
                            </small>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body pt-2">
                            <!-- Tanggal -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-calendar-date text-muted me-2"></i>
                                    <div>
                                        <small class="text-muted">Mulai</small>
                                        <div>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar-check text-muted me-2"></i>
                                    <div>
                                        <small class="text-muted">Selesai</small>
                                        <div>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Lainnya -->
                            <div class="mb-2">
                                <i class="bi bi-clock-history text-muted me-2"></i>
                                <span>{{ $item->durasi }} hari</span>
                            </div>

                            @if($item->tujuan)
                                <div class="mb-3">
                                    <i class="bi bi-card-text text-muted me-2"></i>
                                    <small class="text-truncate d-inline-block" style="max-width: 100%;">
                                        {{ Str::limit($item->tujuan, 100) }}
                                    </small>
                                </div>
                            @endif

                            <div class="mb-2">
                                <i class="bi bi-cash-coin text-muted me-2"></i>
                                <span class="fw-bold">Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</span>
                            </div>

                            <div class="small text-muted">
                                <i class="bi bi-hash me-1"></i>
                                ID: {{ $item->pinjam_id }}
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer bg-white border-top-0 pt-0">
                            <div class="d-flex justify-content-end gap-2">
                                <!-- Show Button -->
                                <a href="{{ route('peminjaman.show', $item->pinjam_id) }}" class="btn btn-sm btn-outline-info"
                                    title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('peminjaman.edit', $item->pinjam_id) }}"
                                    class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Quick Actions untuk Pending -->
                                @if ($item->status == 'pending')
                                    <form action="{{ route('peminjaman.status', $item->pinjam_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Setujui"
                                            onclick="return confirm('Setujui peminjaman?')">
                                            <i class="bi bi-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('peminjaman.status', $item->pinjam_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Tolak"
                                            onclick="return confirm('Tolak peminjaman?')">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </form>
                                @endif

                                <!-- Delete Button -->
                                <form action="{{ route('peminjaman.destroy', $item->pinjam_id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Hapus data peminjaman?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-calendar-x display-1 text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-3">Belum ada data peminjaman</h5>
                            <a href="{{ route('peminjaman.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle me-2"></i> Ajukan Peminjaman Pertama
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $peminjaman->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <style>
        .badge {
            font-size: 0.75em;
            padding: 0.35em 0.65em;
        }

        .card {
            transition: transform 0.2s;
            border-radius: 10px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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