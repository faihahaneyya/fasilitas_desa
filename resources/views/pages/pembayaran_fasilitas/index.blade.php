@extends('layouts.guest.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-cash-stack text-primary me-2"></i> Daftar Pembayaran
            </h4>
            <p class="text-muted mb-0">Daftar semua pembayaran fasilitas</p>
        </div>
        <a href="{{ route('pembayaran-fasilitas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Pembayaran
        </a>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($pembayaran as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">

                {{-- Header --}}
                <div class="card-header bg-white border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="fw-bold mb-1">
                                Peminjaman #{{ $item->pinjam_id }}
                            </h6>

                            @if($item->peminjaman && $item->peminjaman->fasilitas)
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-building me-1"></i>
                                    {{ $item->peminjaman->fasilitas->name }}
                                </p>
                            @endif
                        </div>

                        <span class="badge bg-{{
                            $item->jumlah > 1000000 ? 'success' :
                            ($item->jumlah > 500000 ? 'primary' : 'warning')
                        }}">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </span>
                    </div>

                    <small class="text-muted">
                        <i class="bi bi-calendar me-1"></i>
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                    </small>
                </div>

                {{-- Body --}}
                <div class="card-body pt-2">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-credit-card text-muted me-2"></i>
                            <span>Metode: {{ ucfirst($item->metode) }}</span>
                        </div>

                        @if($item->keterangan)
                            <p class="text-muted small mb-0">
                                <i class="bi bi-chat-left-text me-2"></i>
                                {{ $item->keterangan }}
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Footer --}}
                <div class="card-footer bg-white border-0 pt-0">
                    <div class="d-flex justify-content-end">
                        <div class="btn-group" role="group">

                            {{-- DETAIL --}}
                            <a href="{{ route('pembayaran-fasilitas.show', $item->bayar_id) }}"
                               class="btn btn-sm btn-outline-primary"
                               title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            {{-- EDIT --}}
                            <a href="{{ route('pembayaran-fasilitas.edit', $item->bayar_id) }}"
                               class="btn btn-sm btn-outline-warning"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('pembayaran-fasilitas.destroy', $item->bayar_id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus pembayaran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bi bi-cash-stack display-1 text-muted mb-3"></i>
                    <h5 class="text-muted mb-3">Belum ada data pembayaran</h5>
                    <a href="{{ route('pembayaran-fasilitas.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Pembayaran Pertama
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($pembayaran->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $pembayaran->links() }}
        </div>
    @endif
</div>

<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
    }
</style>
@endsection
