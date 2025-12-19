@extends('layouts.guest.app')

@section('title', 'Data Warga')

@section('content')
    <div class="container-fluid">
        <!-- Header dengan Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <div>
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-people-fill text-success me-2"></i> Data Warga
                </h4>
                <p class="text-muted mb-0">Total: {{ $warga->total() }} warga</p>
            </div>
            <a href="{{ route('warga.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i> Tambah Warga
            </a>
        </div>

        <!-- Data Warga dalam Card Grid -->
        <div class="row">
            @forelse ($warga as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <!-- Card Header dengan Nama -->
                        <div class="card-header bg-white border-bottom-0 pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="fw-bold mb-1">{{ $item->nama }}</h6>
                                <span class="badge {{ $item->jenis_kelamin == 'L' ? 'bg-primary' : 'bg-danger' }} badge-sm">
                                    {{ $item->jenis_kelamin_formatted }}
                                </span>
                            </div>
                            <small class="text-muted">NIK: {{ $item->no_ktp }}</small>
                        </div>

                        <!-- Card Body dengan Informasi -->
                        <div class="card-body pt-2">
                            <div class="mb-2">
                                <i class="bi bi-person-badge text-muted me-2"></i>
                                <span>{{ $item->agama }}</span>
                            </div>
                            <div class="mb-2">
                                <i class="bi bi-briefcase text-muted me-2"></i>
                                <span>{{ $item->pekerjaan }}</span>
                            </div>
                            @if ($item->telp)
                                <div class="mb-2">
                                    <i class="bi bi-telephone text-muted me-2"></i>
                                    <span>{{ $item->telp }}</span>
                                </div>
                            @endif
                            @if ($item->email)
                                <div>
                                    <i class="bi bi-envelope text-muted me-2"></i>
                                    <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                        {{ $item->email }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer dengan Tombol Aksi -->
                        <div class="card-footer bg-white border-top-0 pt-0">
                            <div class="d-flex justify-content-end">
                                <!-- Show Button -->
                                <a href="{{ route('warga.show', $item->warga_id) }}"
                                    class="btn btn-sm btn-outline-info me-2" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('warga.edit', $item->warga_id) }}"
                                    class="btn btn-sm btn-outline-warning me-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Hapus data warga ini?')">
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
                                <i class="bi bi-people display-1 text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-3">Belum ada data warga</h5>
                            <a href="{{ route('warga.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle me-2"></i> Tambah Warga Pertama
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

         <!-- Pagination -->
        @if ($warga->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
                <!-- Info Results -->
                <div class="text-muted">
                    <small>
                        Menampilkan {{ ($warga->currentPage() - 1) * $warga->perPage() + 1 }}
                        sampai {{ min($warga->currentPage() * $warga->perPage(), $warga->total()) }}
                        dari {{ $warga->total() }} warga
                    </small>
                </div>

                <!-- Pagination Controls -->
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0" style="gap: 6px;">
                        {{-- Previous Page Link --}}
                        @if ($warga->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                    style="width: 36px; height: 36px; background-color: #f8f9fa; border-color: #e9ecef;">
                                    <i class="bi bi-chevron-left text-muted" style="font-size: 0.9rem;"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm"
                                    href="{{ $warga->previousPageUrl() }}" rel="prev"
                                    style="width: 36px; height: 36px; background-color: #fff; border-color: #dee2e6; color: #6c757d;"
                                    title="Sebelumnya">
                                    <i class="bi bi-chevron-left" style="font-size: 0.9rem;"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @php
                            $current = $warga->currentPage();
                            $last = $warga->lastPage();
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
                                    href="{{ $warga->url(1) }}"
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
                            @if ($page == $warga->currentPage())
                                <li class="page-item active">
                                    <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow"
                                        style="width: 36px; height: 36px; background: linear-gradient(135deg, #a7e9af, #86c8bc); border: none; color: #fff; font-weight: 600; font-size: 0.9rem;">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                        href="{{ $warga->url($page) }}"
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
                                    href="{{ $warga->url($last) }}"
                                    style="width: 36px; height: 36px; background-color: #f8f9fa; border: 2px solid #e9ecef; color: #6c757d; font-weight: 500; font-size: 0.9rem;"
                                    title="Halaman {{ $last }}">
                                    {{ $last }}
                                </a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($warga->hasMorePages())
                            <li class="page-item">
                                <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm"
                                    href="{{ $warga->nextPageUrl() }}" rel="next"
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
        .badge-sm {
            font-size: 0.75em;
            padding: 0.25em 0.5em;
        }

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
    </style>
@endsection
