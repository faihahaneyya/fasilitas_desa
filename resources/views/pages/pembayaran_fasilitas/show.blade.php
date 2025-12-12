@extends('layouts.guest.app')

@section('title', 'Detail Pembayaran')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-file-earmark-text text-info me-2"></i> Detail Pembayaran
                </h4>
                <p class="text-muted mb-0">ID: #{{ $pembayaran->bayar_id }}</p>
            </div>
            <span class="badge bg-info fs-6 px-3 py-2">
                <i class="bi bi-calendar me-2"></i>{{ $pembayaran->tanggal->format('d F Y') }}
            </span>
        </div>

        <div class="row">
            <!-- Card Utama -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <!-- Card Header -->
                    <div class="card-header bg-white border-bottom-0 pb-0">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="fw-bold mb-2">Informasi Pembayaran</h5>
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle me-1"></i> Lunas
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Jumlah Pembayaran -->
                        <div class="text-center mb-5">
                            <div class="display-6 fw-bold text-primary">
                                Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-2">
                                <span class="badge bg-primary fs-6">
                                    {{ strtoupper($pembayaran->metode) }}
                                </span>
                                <span class="ms-3 text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $pembayaran->created_at->format('H:i') }}
                                </span>
                            </div>
                        </div>

                        <!-- Informasi Peminjaman -->
                        @if ($pembayaran->peminjaman)
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">
                                    <i class="bi bi-link-45deg text-muted me-2"></i> Informasi Peminjaman Terkait
                                </h6>
                                <div class="border rounded p-3 bg-light">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="small text-muted">ID Peminjaman</div>
                                            <div class="fw-semibold">#{{ $pembayaran->peminjaman->pinjam_id }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="small text-muted">Tanggal Peminjaman</div>
                                            <div class="fw-semibold">
                                                @if (isset($pembayaran->peminjaman->tanggal_pinjam))
                                                    {{ \Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_pinjam)->format('d M Y') }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Keterangan -->
                        @if ($pembayaran->keterangan)
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">
                                    <i class="bi bi-card-text text-muted me-2"></i> Keterangan
                                </h6>
                                <div class="border rounded p-3 bg-light">
                                    <p class="mb-0">{{ $pembayaran->keterangan }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Timeline -->
                        <div>
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-clock-history text-muted me-2"></i> Timeline
                            </h6>
                            <div class="timeline">
                                <div class="d-flex align-items-center mb-3">
                                    <div
                                        class="timeline-icon bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="bi bi-plus text-white"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Pembayaran Dibuat</div>
                                        <div class="text-muted small">{{ $pembayaran->created_at->format('d M Y, H:i') }}
                                        </div>
                                    </div>
                                </div>
                                @if ($pembayaran->updated_at != $pembayaran->created_at)
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="timeline-icon bg-warning rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <i class="bi bi-pencil text-white"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">Terakhir Diperbarui</div>
                                            <div class="text-muted small">
                                                {{ $pembayaran->updated_at->format('d M Y, H:i') }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Action Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom-0">
                        <h6 class="fw-bold mb-0">Aksi</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('pembayaran-fasilitas.edit', $pembayaran->bayar_id) }}"
                                class="btn btn-warning">
                                <i class="bi bi-pencil me-2"></i> Edit Pembayaran
                            </a>
                            <form action="{{ route('pembayaran-fasilitas.destroy', $pembayaran->bayar_id) }}"
                                method="POST" class="d-grid" onsubmit="return confirm('Hapus pembayaran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash me-2"></i> Hapus Pembayaran
                                </button>
                            </form>
                            <a href="{{ route('pembayaran-fasilitas.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-list me-2"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0">
                        <h6 class="fw-bold mb-0">Informasi Detail</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6 text-muted">ID Pembayaran</div>
                            <div class="col-6 fw-semibold text-end">#{{ $pembayaran->bayar_id }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">ID Peminjaman</div>
                            <div class="col-6 fw-semibold text-end">#{{ $pembayaran->pinjam_id }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Metode</div>
                            <div class="col-6 fw-semibold text-end">{{ ucfirst($pembayaran->metode) }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-muted">Status</div>
                            <div class="col-6 fw-semibold text-end text-success">
                                <i class="bi bi-check-circle-fill me-1"></i>Lunas
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 12px;
        }

        .badge {
            font-size: 0.9em;
        }

        .display-6 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .timeline-icon {
            width: 40px;
            height: 40px;
        }

        .btn {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-weight: 500;
        }

        .d-grid {
            display: grid;
        }

        .gap-2 {
            gap: 0.75rem;
        }
    </style>
@endsection
