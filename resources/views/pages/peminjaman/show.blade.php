@extends('layouts.guest.app')

@section('title', 'Detail Peminjaman')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-file-earmark-text text-success me-2"></i> Detail Peminjaman
                        </h5>
                        <div class="btn-group" role="group">
                            <a href="{{ route('peminjaman.edit', $peminjaman->pinjam_id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Status Badge -->
                        <div class="mb-4 text-center">
                            <span class="badge bg-{{ $peminjaman->status_color }} fs-6 px-4 py-2">
                                Status: {{ $peminjaman->status_label }}
                            </span>
                        </div>

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">Informasi Fasilitas</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="120">Fasilitas</th>
                                        <td>: {{ $peminjaman->fasilitas->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis</th>
                                        <td>: {{ $peminjaman->fasilitas->jenis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lokasi</th>
                                        <td>: {{ $peminjaman->fasilitas->lokasi }}</td>
                                    </tr>
                                    @if ($peminjaman->fasilitas->kapasitas)
                                        <tr>
                                            <th>Kapasitas</th>
                                            <td>: {{ number_format($peminjaman->fasilitas->kapasitas) }} orang</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">Informasi Peminjam</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="120">Nama</th>
                                        <td>: {{ $peminjaman->warga->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td>: {{ $peminjaman->warga->no_ktp }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. Telepon</th>
                                        <td>: {{ $peminjaman->warga->telp ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>: {{ $peminjaman->warga->email ?: '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <!-- Detail Peminjaman -->
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">Detail Peminjaman</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="120">Tanggal Mulai</th>
                                        <td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Selesai</th>
                                        <td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Durasi</th>
                                        <td>: {{ $peminjaman->durasi }} hari</td>
                                    </tr>
                                    <tr>
                                        <th>Total Biaya</th>
                                        <td>: <strong>Rp
                                                {{ number_format($peminjaman->total_biaya, 0, ',', '.') }}</strong></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">Tujuan Peminjaman</h6>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <p class="mb-0">{{ $peminjaman->tujuan }}</p>
                                    </div>
                                </div>

                                @if ($peminjaman->catatan)
                                    <h6 class="fw-bold mb-3 mt-3">Catatan</h6>
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <p class="mb-0">{{ $peminjaman->catatan }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @if ($peminjaman->status == 'pending')
                            <div class="mt-4 pt-3 border-top text-center">
                                <h6 class="fw-bold mb-3">Konfirmasi Peminjaman</h6>
                                <div class="d-flex justify-content-center gap-3">
                                    <form action="{{ route('peminjaman.status', $peminjaman->pinjam_id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-success"
                                            onclick="return confirm('Setujui peminjaman ini?')">
                                            <i class="bi bi-check-circle me-2"></i> Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('peminjaman.status', $peminjaman->pinjam_id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-danger"
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
                                <i class="bi bi-clock me-1"></i>
                                Dibuat: {{ $peminjaman->created_at->format('d/m/Y H:i') }}
                            </div>
                            <div class="col-md-6 text-end">
                                <i class="bi bi-arrow-clockwise me-1"></i>
                                Diupdate: {{ $peminjaman->updated_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
