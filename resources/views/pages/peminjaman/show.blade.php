@extends('layouts.guest.app')

@section('title', 'Detail Peminjaman')

@section('content')
    <div class="containerpy-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-0">Detail Peminjaman</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
                                <li class="breadcrumb-item active">ID: {{ $peminjaman->pinjam_id }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="{{ route('peminjaman.edit', $peminjaman->pinjam_id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i>Edit
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0 fw-bold text-success">Data Peminjaman</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="text-muted w-30">Status</th>
                                        <td>
                                            <span class="badge bg-{{ $peminjaman->status_color }} fs-6">
                                                {{ $peminjaman->status_label }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Fasilitas</th>
                                        <td class="fw-bold">{{ $peminjaman->fasilitas->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Peminjam</th>
                                        <td>
                                            <div class="fw-bold">{{ $peminjaman->warga->nama }}</div>
                                            <small class="text-muted">NIK: {{ $peminjaman->warga->no_ktp }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Periode</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="text-success fw-bold">{{ $peminjaman->tanggal_mulai->format('d M Y') }}</span>
                                                <i class="bi bi-arrow-right mx-2 text-muted"></i>
                                                <span class="text-danger fw-bold">{{ $peminjaman->tanggal_selesai->format('d M Y') }}</span>
                                            </div>
                                            <small class="text-muted">Durasi: {{ $peminjaman->durasi }} Hari</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Total Biaya</th>
                                        <td class="fs-5 fw-bold text-primary">
                                            Rp {{ number_format($peminjaman->total_biaya, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Tujuan</th>
                                        <td>{{ $peminjaman->tujuan }}</td>
                                    </tr>
                                    @if($peminjaman->catatan)
                                        <tr>
                                            <th class="text-muted">Catatan</th>
                                            <td><p class="mb-0 text-italic text-muted">"{{ $peminjaman->catatan }}"</p></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold"><i class="bi bi-paperclip me-2 text-info"></i>Lampiran</h5>
                                <span class="badge bg-light text-dark border">{{ $peminjaman->media->count() }} File</span>
                            </div>
                            <div class="card-body">
                                @if($peminjaman->media && $peminjaman->media->count() > 0)
                                    <div class="row g-3">
                                        @foreach($peminjaman->media as $media)
                                            <div class="col-6">
                                                <div class="media-container border rounded overflow-hidden shadow-sm">
                                                    @php
                                                        $isImage = Str::startsWith($media->mime_type, 'image/');
                                                    @endphp

                                                    <a href="{{ asset('storage/' . $media->file_name) }}" target="_blank" class="text-decoration-none">
                                                        @if($isImage)
                                                            <div class="ratio ratio-1x1 bg-light">
                                                                <img src="{{ asset('storage/' . $media->file_name) }}" 
                                                                     class="img-fluid object-fit-cover" 
                                                                     alt="{{ $media->caption }}">
                                                            </div>
                                                        @else
                                                            <div class="ratio ratio-1x1 bg-light d-flex flex-column align-items-center justify-content-center">
                                                                <div class="text-center p-2">
                                                                    <i class="bi bi-file-earmark-pdf text-danger display-4"></i>
                                                                    <div class="small text-muted text-truncate mt-1 px-2" style="max-width: 150px;">
                                                                        {{ basename($media->file_name) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="p-2 bg-white border-top">
                                                            <small class="d-block text-dark fw-bold text-truncate" title="{{ $media->caption }}">
                                                                {{ $media->caption ?? 'Tanpa Keterangan' }}
                                                            </small>
                                                            <small class="text-muted" style="font-size: 0.7rem;">
                                                                Klik untuk lihat <i class="bi bi-box-arrow-up-right ms-1"></i>
                                                            </small>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5 text-muted">
                                        <i class="bi bi-images display-4 mb-2"></i>
                                        <p>Tidak ada lampiran dokumen.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .w-30 { width: 30%; }
        .object-fit-cover { object-fit: cover; }

        .media-container {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .media-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            font-size: 1.2rem;
            line-height: 1;
            vertical-align: middle;
        }

        .table th {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .table td {
            font-size: 0.95rem;
        }
    </style>
@endsection