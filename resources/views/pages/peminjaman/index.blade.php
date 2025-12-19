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
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
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
                                    {{ number_format(\App\Models\PeminjamanFasilitas::sum('total_biaya'), 0, ',', '.') }}</h5>
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
                                <a href="{{ route('peminjaman.show', $item->pinjam_id) }}"
                                    class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('peminjaman.edit', $item->pinjam_id) }}"
                                    class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Quick Actions untuk Pending -->
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

                                <!-- Delete Button -->
                                <form action="{{ route('peminjaman.destroy', $item->pinjam_id) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus data peminjaman?')">
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
        @if ($peminjaman->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
                <!-- Info Results -->
                <div class="text-muted">
                    <small>
                        Menampilkan {{ ($peminjaman->currentPage() - 1) * $peminjaman->perPage() + 1 }}
                        sampai {{ min($peminjaman->currentPage() * $peminjaman->perPage(), $peminjaman->total()) }}
                        dari {{ $peminjaman->total() }} peminjaman
                    </small>
                </div>

                <!-- Pagination Controls -->
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0" style="gap: 6px;">
                        {{-- Previous Page Link --}}
                        @if ($peminjaman->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                    style="width: 36px; height: 36px; background-color: #f8f9fa; border-color: #e9ecef;">
                                    <i class="bi bi-chevron-left text-muted" style="font-size: 0.9rem;"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm"
                                    href="{{ $peminjaman->previousPageUrl() }}" rel="prev"
                                    style="width: 36px; height: 36px; background-color: #fff; border-color: #dee2e6; color: #6c757d;"
                                    title="Sebelumnya">
                                    <i class="bi bi-chevron-left" style="font-size: 0.9rem;"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @php
                            $current = $peminjaman->currentPage();
                            $last = $peminjaman->lastPage();
                            $start = max(1, $current - 2);
                            $end = min($last, $current + 2);

                            if ($start == 1) {
                                $end = min($last, 5);
                            }

                            if ($end == $last) {
                                $start = max(1, $last - 4);
                            }
                        @endphp

                        {{-- First page --}}
                        @if ($start > 1)
                            <li class="page-item">
                                <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                    href="{{ $peminjaman->url(1) }}"
                                    style="width: 36px; height: 36px; background-color: #f8f9fa; border: 2px solid #e9ecef; color: #6c757d; font-weight: 500; font-size: 0.9rem;"
                                    title="Halaman 1">
                                    1
                                </a>
                            </li>
                            @if ($start > 2)
                                <li class="page-item disabled">
                                    <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                        style="width: 36px; height: 36px; background-color: transparent; border: none; color: #adb5bd; cursor: default;">
                                        ...
                                    </span>
                                </li>
                            @endif
                        @endif

                        {{-- Page Numbers --}}
                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page == $peminjaman->currentPage())
                                <li class="page-item active">
                                    <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow"
                                        style="width: 36px; height: 36px; background: linear-gradient(135deg, #a7e9af, #86c8bc); border: none; color: #fff; font-weight: 600; font-size: 0.9rem;">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                        href="{{ $peminjaman->url($page) }}"
                                        style="width: 36px; height: 36px; background-color: #f8f9fa; border: 2px solid #e9ecef; color: #6c757d; font-weight: 500; font-size: 0.9rem;"
                                        title="Halaman {{ $page }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endfor

                        {{-- Last page --}}
                        @if ($end < $last)
                            @if ($end < $last - 1)
                                <li class="page-item disabled">
                                    <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                        style="width: 36px; height: 36px; background-color: transparent; border: none; color: #adb5bd; cursor: default;">
                                        ...
                                    </span>
                                </li>
                            @endif
                            <li class="page-item">
                                <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                    href="{{ $peminjaman->url($last) }}"
                                    style="width: 36px; height: 36px; background-color: #f8f9fa; border: 2px solid #e9ecef; color: #6c757d; font-weight: 500; font-size: 0.9rem;"
                                    title="Halaman {{ $last }}">
                                    {{ $last }}
                                </a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($peminjaman->hasMorePages())
                            <li class="page-item">
                                <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm"
                                    href="{{ $peminjaman->nextPageUrl() }}" rel="next"
                                    style="width: 36px; height: 36px; background-color: #fff; border-color: #dee2e6; color: #6c757d;"
                                    title="Selanjutnya">
                                    <i class="bi bi-chevron-right" style="font-size: 0.9rem;"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                    style="width: 36px; height: 36px; background-color: #f8f9fa; border-color: #e9ecef;">
                                    <i class="bi bi-chevron-right text-muted" style="font-size: 0.9rem;"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>

            <style>
                .pagination .page-link {
                    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .pagination .page-link:hover:not(.disabled):not(.active) {
                    transform: translateY(-2px) scale(1.05);
                    background-color: #fff !important;
                    border-color: #a7e9af !important;
                    box-shadow: 0 4px 10px rgba(167, 233, 175, 0.3) !important;
                    color: #5a8c7e !important;
                }

                .pagination .page-item.active .page-link {
                    animation: gentlePulse 2s infinite;
                    box-shadow: 0 4px 12px rgba(134, 200, 188, 0.3) !important;
                }

                @keyframes gentlePulse {
                    0%, 100% { transform: scale(1); }
                    50% { transform: scale(1.04); }
                }

                .pagination {
                    align-items: center;
                    margin: 0;
                }

                .pagination .page-item:first-child .page-link,
                .pagination .page-item:last-child .page-link {
                    background-color: #f0f9ff !important;
                    border-color: #cce7ff !important;
                }

                .pagination .page-item:first-child .page-link:hover:not(.disabled),
                .pagination .page-item:last-child .page-link:hover:not(.disabled) {
                    background-color: #e6f7ff !important;
                    border-color: #86c8bc !important;
                }

                .pagination .page-link:not(.active) {
                    position: relative;
                    overflow: hidden;
                }

                .pagination .page-link:not(.active)::before {
                    content: '';
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 0;
                    height: 0;
                    border-radius: 50%;
                    background-color: rgba(167, 233, 175, 0.1);
                    transform: translate(-50%, -50%);
                    transition: width 0.3s, height 0.3s;
                }

                .pagination .page-link:not(.active):hover::before {
                    width: 100%;
                    height: 100%;
                }
            </style>
        @endif
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
