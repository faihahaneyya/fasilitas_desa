@extends('layouts.guest.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-file-earmark-text text-success me-2"></i> Detail Peminjaman
                        <span class="badge bg-{{ $peminjaman->status_color }} ms-2">
                            {{ $peminjaman->status_label }}
                        </span>
                    </h5>
                    <div class="btn-group" role="group">
                        <a href="{{ route('peminjaman.edit', $peminjaman->pinjam_id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Informasi Utama -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="bi bi-building me-2"></i>Informasi Fasilitas
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <th width="100">Nama</th>
                                            <td>: <strong>{{ $peminjaman->fasilitas->name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis</th>
                                            <td>:
                                                <span class="badge bg-{{ $peminjaman->fasilitas->jenis_color }}">
                                                    {{ $peminjaman->fasilitas->jenis }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>: {{ $peminjaman->fasilitas->lokasi }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>: {{ $peminjaman->fasilitas->alamat }}</td>
                                        </tr>
                                        @if($peminjaman->fasilitas->kapasitas)
                                        <tr>
                                            <th>Kapasitas</th>
                                            <td>: {{ number_format($peminjaman->fasilitas->kapasitas) }} orang</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="bi bi-person me-2"></i>Informasi Peminjam
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <th width="100">Nama</th>
                                            <td>: <strong>{{ $peminjaman->warga->nama }}</strong></td>
                                        </tr>
                                        <tr>
                                            <th>NIK</th>
                                            <td>: {{ $peminjaman->warga->no_ktp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Telp</th>
                                            <td>: {{ $peminjaman->warga->telp ?: '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>: {{ $peminjaman->warga->email ?: '-' }}</td>
                                        </tr>
                                        @if($peminjaman->warga->alamat)
                                        <tr>
                                            <th>Alamat</th>
                                            <td>: {{ $peminjaman->warga->alamat }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Peminjaman -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="card border">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="bi bi-calendar-event me-2"></i>Detail Peminjaman
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless mb-0">
                                                <tr>
                                                    <th width="120">Tanggal Mulai</th>
                                                    <td>:
                                                        <strong>
                                                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d F Y') }}
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Selesai</th>
                                                    <td>:
                                                        <strong>
                                                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d F Y') }}
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Durasi</th>
                                                    <td>: <strong>{{ $peminjaman->durasi }} hari</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Total Biaya</th>
                                                    <td>:
                                                        <strong class="text-success">
                                                            Rp {{ number_format($peminjaman->total_biaya, 0, ',', '.') }}
                                                        </strong>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="alert alert-info h-100">
                                                <h6 class="alert-heading">
                                                    <i class="bi bi-info-circle me-2"></i>Tujuan Peminjaman
                                                </h6>
                                                <p class="mb-0">{{ $peminjaman->tujuan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="bi bi-clock-history me-2"></i>Status Timeline
                                    </h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="timeline">
                                        <div class="timeline-item {{ $peminjaman->status == 'pending' ? 'active' : '' }}">
                                            <div class="timeline-marker bg-warning"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Menunggu</h6>
                                                <small>Status awal</small>
                                            </div>
                                        </div>
                                        <div class="timeline-item {{ $peminjaman->status == 'approved' ? 'active' : '' }}">
                                            <div class="timeline-marker bg-info"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Disetujui</h6>
                                                <small>Dikonfirmasi oleh admin</small>
                                            </div>
                                        </div>
                                        <div class="timeline-item {{ $peminjaman->status == 'rejected' ? 'active' : '' }}">
                                            <div class="timeline-marker bg-danger"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Ditolak</h6>
                                                <small>Ditolak oleh admin</small>
                                            </div>
                                        </div>
                                        <div class="timeline-item {{ $peminjaman->status == 'completed' ? 'active' : '' }}">
                                            <div class="timeline-marker bg-success"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Selesai</h6>
                                                <small>Peminjaman selesai</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ======================== -->
                    <!-- DOKUMEN PENDUKUNG -->
                    <!-- ======================== -->
                    @if($peminjaman->media && $peminjaman->media->count() > 0)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <i class="bi bi-files me-2"></i>Dokumen Pendukung
                                        <span class="badge bg-primary ms-2">{{ $peminjaman->media->count() }} dokumen</span>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        @foreach($peminjaman->media as $media)
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="card border h-100">
                                                @if($media->mime_type && Str::startsWith($media->mime_type, 'image/'))
                                                <a href="{{ $media->getUrl() }}"
                                                   data-fancybox="dokumen-peminjaman"
                                                   data-caption="{{ $media->getCustomProperty('deskripsi') ?? 'Dokumen Peminjaman' }}">
                                                    <img src="{{ $media->getUrl() }}"
                                                         alt="{{ $media->getCustomProperty('deskripsi') ?? 'Dokumen' }}"
                                                         class="card-img-top"
                                                         style="height: 150px; object-fit: cover; cursor: pointer;">
                                                </a>
                                                @else
                                                <div class="card-body text-center py-4">
                                                    <i class="bi bi-file-earmark-text display-4 text-muted"></i>
                                                    <p class="card-text small mt-2 mb-1">
                                                        {{ $media->getCustomProperty('deskripsi') ?? $media->file_name }}
                                                    </p>
                                                    <small class="text-muted">
                                                        {{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }}
                                                        • {{ number_format($media->size / 1024, 1) }} KB
                                                    </small>
                                                </div>
                                                @endif
                                                <div class="card-footer bg-white border-top-0 pt-0">
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ $media->getUrl() }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-primary"
                                                           title="Lihat">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ $media->getUrl() }}"
                                                           download="{{ $media->file_name }}"
                                                           class="btn btn-sm btn-outline-success"
                                                           title="Download">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                        @if($media->getCustomProperty('deskripsi'))
                                                        <button type="button"
                                                                class="btn btn-sm btn-outline-info"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ $media->getCustomProperty('deskripsi') }}">
                                                            <i class="bi bi-info-circle"></i>
                                                        </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Catatan dan Informasi Tambahan -->
                    <div class="row">
                        @if($peminjaman->catatan)
                        <div class="col-md-6">
                            <div class="card border">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="bi bi-chat-text me-2"></i>Catatan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">{{ $peminjaman->catatan }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="{{ $peminjaman->catatan ? 'col-md-6' : 'col-md-12' }}">
                            <div class="card border">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="bi bi-clock-history me-2"></i>Riwayat Sistem
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <th width="120">Dibuat</th>
                                            <td>: {{ $peminjaman->created_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Diupdate</th>
                                            <td>: {{ $peminjaman->updated_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                        @if($peminjaman->approved_by && $peminjaman->approved_at)
                                        <tr>
                                            <th>Disetujui Oleh</th>
                                            <td>: {{ $peminjaman->approved_by_user->name ?? 'Admin' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Setujui</th>
                                            <td>: {{ $peminjaman->approved_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                        @endif
                                        @if($peminjaman->completed_at)
                                        <tr>
                                            <th>Selesai Pada</th>
                                            <td>: {{ $peminjaman->completed_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @if($peminjaman->status == 'pending')
                    <div class="mt-4 pt-3 border-top text-center">
                        <h6 class="fw-bold mb-3">Konfirmasi Peminjaman</h6>
                        <div class="d-flex justify-content-center gap-3">
                            <form action="{{ route('peminjaman.status', $peminjaman->pinjam_id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-success btn-lg px-4"
                                        onclick="return confirm('Setujui peminjaman ini?')">
                                    <i class="bi bi-check-circle me-2"></i> Setujui
                                </button>
                            </form>
                            <form action="{{ route('peminjaman.status', $peminjaman->pinjam_id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger btn-lg px-4"
                                        onclick="return confirm('Tolak peminjaman ini?')">
                                    <i class="bi bi-x-circle me-2"></i> Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-white text-muted small">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="bi bi-hash me-1"></i>
                            ID Peminjaman: <strong>{{ $peminjaman->pinjam_id }}</strong>
                        </div>
                        <div class="col-md-6 text-end">
                            <i class="bi bi-calendar me-1"></i>
                            Terakhir diupdate: {{ $peminjaman->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Fancybox untuk lightbox gallery -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<style>
    [data-fancybox] {
        cursor: zoom-in;
    }
    .card-img-top {
        transition: transform 0.3s ease;
    }
    .card-img-top:hover {
        transform: scale(1.03);
    }
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e9ecef;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }
    .timeline-item.active .timeline-marker {
        box-shadow: 0 0 0 3px rgba(var(--bs-primary-rgb), 0.2);
    }
    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 0;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: #dee2e6;
        border: 2px solid #fff;
    }
    .timeline-content {
        padding-left: 10px;
    }
    .timeline-content h6 {
        font-size: 0.9rem;
        font-weight: 600;
    }
    .timeline-content small {
        color: #6c757d;
        font-size: 0.8rem;
    }
    .badge {
        font-weight: 500;
    }
</style>
@endpush

@push('scripts')
<!-- Fancybox untuk lightbox gallery -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    // Inisialisasi Fancybox
    Fancybox.bind("[data-fancybox]", {
        infinite: true,
        Thumbs: {
            autoStart: true,
        },
        Toolbar: {
            display: {
                left: [],
                middle: [],
                right: ["close"],
            },
        },
    });

    // Inisialisasi tooltip
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush
