@extends('layouts.guest.app')

@section('title', 'Pembayaran Fasilitas')

@section('content')
<div class="container-fluid vh-100">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-credit-card text-primary me-2"></i> Pembayaran Fasilitas
            </h4>
            <p class="text-muted mb-0">Total: {{ $pembayaran->total() }} pembayaran</p>
        </div>
        <a href="{{ route('pembayaran-fasilitas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Pembayaran
        </a>
    </div>

    <!-- Search Form -->
    {{-- <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('pembayaran-fasilitas.search') }}" method="GET" class="row g-2">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0"
                               placeholder="Cari pembayaran..."
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div> --}}

    <!-- Pembayaran Cards -->
    <div class="row">
        @forelse ($pembayaran as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <!-- Card Header -->
                <div class="card-header bg-white border-bottom-0 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <h6 class="fw-bold mb-1">Pembayaran #{{ $item->bayar_id }}</h6>
                        <span class="badge bg-{{ $item->jumlah > 1000000 ? 'success' : ($item->jumlah > 500000 ? 'primary' : 'warning') }}">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </span>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-calendar me-1"></i> {{ $item->tanggal->format('d/m/Y') }}
                    </small>
                </div>

                <!-- Card Body -->
                <div class="card-body pt-2">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-credit-card text-muted me-2"></i>
                            <span>Metode: {{ ucfirst($item->metode) }}</span>
                        </div>

                        @if($item->keterangan)
                        <div class="mb-3">
                            <i class="bi bi-card-text text-muted me-2"></i>
                            <span class="text-truncate d-inline-block" style="max-width: 100%;">
                                {{ Str::limit($item->keterangan, 100) }}
                            </span>
                        </div>
                        @endif

                        @if($item->peminjaman)
                        <div class="border rounded p-3 bg-light mb-3">
                            <h6 class="fw-bold mb-2">Info Peminjaman</h6>
                            <div class="small">
                                <i class="bi bi-hash text-muted me-1"></i>
                                ID: {{ $item->peminjaman->pinjam_id }}
                            </div>
                        </div>
                        @endif

                        <div class="small text-muted">
                            <i class="bi bi-clock-history me-1"></i>
                            Dibuat: {{ $item->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>

                <!-- Card Footer dengan Tombol Aksi -->
                <div class="card-footer bg-white border-top-0 pt-0">
                    <div class="d-flex justify-content-end gap-2">
                        <!-- Show Button -->
                        <a href="{{ route('pembayaran-fasilitas.show', $item->bayar_id) }}"
                           class="btn btn-sm btn-outline-info"
                           title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>

                        <!-- Edit Button -->
                        <a href="{{ route('pembayaran-fasilitas.edit', $item->bayar_id) }}"
                           class="btn btn-sm btn-outline-warning"
                           title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('pembayaran-fasilitas.destroy', $item->bayar_id) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus pembayaran ini?')">
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
                        <i class="bi bi-credit-card display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-3">Belum ada data pembayaran</h5>
                    <a href="{{ route('pembayaran-fasilitas.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Pembayaran Pertama
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($pembayaran->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($pembayaran->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $pembayaran->previousPageUrl() }}" rel="prev">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($pembayaran->links()->elements[0] as $page => $url)
                    @if ($page == $pembayaran->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($pembayaran->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $pembayaran->nextPageUrl() }}" rel="next">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    @endif

    <!-- Info Box -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle text-primary fs-4 me-3"></i>
                <div>
                    <h6 class="fw-bold mb-1">Informasi</h6>
                    <p class="text-muted mb-0">Total {{ $pembayaran->total() }} pembayaran ditemukan</p>
                </div>
            </div>
        </div>
    </div>
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
