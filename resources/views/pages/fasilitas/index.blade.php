@extends('layouts.guest.app')

@section('title', 'Fasilitas Umum')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-building text-success me-2"></i> Fasilitas Umum
            </h4>
            <p class="text-muted mb-0">Total: {{ $fasilitas->total() }} fasilitas</p>
        </div>
        <a href="{{ route('fasilitas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-2"></i> Tambah Fasilitas
        </a>
    </div>

    <!-- Search Form -->
    {{-- <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('fasilitas.search') }}" method="GET" class="row g-2">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0"
                               placeholder="Cari fasilitas..."
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                </div>
            </form>
        </div> --}}
    </div>

    <!-- Fasilitas Cards -->
    <div class="row">
        @forelse ($fasilitas as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <!-- Card Header -->
                <div class="card-header bg-white border-bottom-0 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="fw-bold mb-1">{{ $item->name }}</h6>
                        <span class="badge bg-{{ $item->jenis_color }}">
                            {{ $item->jenis }}
                        </span>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-geo-alt me-1"></i> {{ $item->lokasi }}
                    </small>
                </div>

                <!-- Card Body -->
                <div class="card-body pt-2">
                    @if($item->kapasitas)
                    <div class="mb-2">
                        <i class="bi bi-people text-muted me-2"></i>
                        <span>Kapasitas: {{ number_format($item->kapasitas) }} orang</span>
                    </div>
                    @endif

                    @if($item->deskripsi)
                    <div class="mb-2">
                        <i class="bi bi-card-text text-muted me-2"></i>
                        <span class="text-truncate d-inline-block" style="max-width: 100%;">
                            {{ Str::limit($item->deskripsi, 100) }}
                        </span>
                    </div>
                    @endif

                    <div class="small text-muted">
                        <i class="bi bi-calendar me-1"></i>
                        Dibuat: {{ $item->created_at->format('d/m/Y') }}
                    </div>
                </div>

                <!-- Card Footer dengan Tombol Aksi -->
                <div class="card-footer bg-white border-top-0 pt-0">
                    <div class="d-flex justify-content-end gap-2">
                        <!-- Show Button -->
                        <a href="{{ route('fasilitas.show', $item->fasilitas_id) }}"
                           class="btn btn-sm btn-outline-info"
                           title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>

                        <!-- Edit Button -->
                        <a href="{{ route('fasilitas.edit', $item->fasilitas_id) }}"
                           class="btn btn-sm btn-outline-warning"
                           title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('fasilitas.destroy', $item->fasilitas_id) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus fasilitas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    title="Hapus">
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
                        <i class="bi bi-building display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-3">Belum ada data fasilitas</h5>
                    <a href="{{ route('fasilitas.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Fasilitas Pertama
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    <!-- Pagination -->
    @if ($fasilitas->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
            <!-- Info Results -->
            <div class="text-muted">
                <small>
                    Menampilkan {{ ($fasilitas->currentPage() - 1) * $fasilitas->perPage() + 1 }}
                    sampai {{ min($fasilitas->currentPage() * $fasilitas->perPage(), $fasilitas->total()) }}
                    dari {{ $fasilitas->total() }} fasilitas
                </small>
            </div>

            <!-- Pagination Controls -->
            <nav aria-label="Page navigation">
                <ul class="pagination mb-0" style="gap: 6px;">
                    {{-- Previous Page Link --}}
                    @if ($fasilitas->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                style="width: 36px; height: 36px; background-color: #f8f9fa; border-color: #e9ecef;">
                                <i class="bi bi-chevron-left text-muted" style="font-size: 0.9rem;"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm"
                                href="{{ $fasilitas->previousPageUrl() }}" rel="prev"
                                style="width: 36px; height: 36px; background-color: #fff; border-color: #dee2e6; color: #6c757d;"
                                title="Sebelumnya">
                                <i class="bi bi-chevron-left" style="font-size: 0.9rem;"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $current = $fasilitas->currentPage();
                        $last = $fasilitas->lastPage();
                        $start = max(1, $current - 2);
                        $end = min($last, $current + 2);

                        // Adjust if at the beginning
                        if ($start == 1) {
                            $end = min($last, 5);
                        }

                        // Adjust if at the end
                        if ($end == $last) {
                            $start = max(1, $last - 4);
                        }
                    @endphp

                    {{-- First page --}}
                    @if ($start > 1)
                        <li class="page-item">
                            <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                href="{{ $fasilitas->url(1) }}"
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
                        @if ($page == $fasilitas->currentPage())
                            <li class="page-item active">
                                <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow"
                                    style="width: 36px; height: 36px; background: linear-gradient(135deg, #a7e9af, #86c8bc); border: none; color: #fff; font-weight: 600; font-size: 0.9rem;">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                    href="{{ $fasilitas->url($page) }}"
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
                                href="{{ $fasilitas->url($last) }}"
                                style="width: 36px; height: 36px; background-color: #f8f9fa; border: 2px solid #e9ecef; color: #6c757d; font-weight: 500; font-size: 0.9rem;"
                                title="Halaman {{ $last }}">
                                {{ $last }}
                            </a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($fasilitas->hasMorePages())
                        <li class="page-item">
                            <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm"
                                href="{{ $fasilitas->nextPageUrl() }}" rel="next"
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

            /* Efek imut untuk angka */
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
    .card {
        transition: transform 0.2s;
        border-radius: 10px;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .btn-sm {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .badge {
        font-size: 0.75em;
    }
</style>
@endsection
