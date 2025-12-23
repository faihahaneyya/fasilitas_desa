@extends('layouts.guest.app')

@section('title', 'Detail Petugas Fasilitas')

@section('content')
    <div class="container-fluid pt-5">
        <div class="card border-0 shadow-sm mt-5">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-person-badge me-2 text-primary"></i> Detail Petugas Fasilitas
                </h5>
                <div>
                    <a href="{{ route('petugas.edit', $petugas->petugas_id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('petugas.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6 class="text-muted text-uppercase small fw-bold mb-3">Informasi Petugas</h6>
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Nama Lengkap</th>
                                <td>: {{ $petugas->warga->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>: <code>{{ $petugas->warga->no_ktp }}</code></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>: {{ $petugas->warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th>No. Telepon</th>
                                <td>: {{ $petugas->warga->telp ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6 mb-4">
                        <h6 class="text-muted text-uppercase small fw-bold mb-3">Detail Penugasan</h6>
                        <div class="p-3 bg-light rounded border">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th width="150">Fasilitas</th>
                                    <td>: <span
                                            class="badge bg-info text-dark">{{ $petugas->fasilitas->name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Peran / Jabatan</th>
                                    <td>: <span class="fw-bold text-primary">{{ $petugas->peran }}</span></td>
                                </tr>
                                <tr>
                                    <th>Didaftarkan pada</th>
                                    <td>: {{ $petugas->created_at->format('d F Y, H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Terakhir Update</th>
                                    <td>: {{ $petugas->updated_at->format('d F Y, H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <h6 class="text-muted text-uppercase small fw-bold mb-3">Catatan Sistem</h6>
                        <p class="small text-muted">
                            Data petugas ini menghubungkan warga <strong>{{ $petugas->warga->nama }}</strong>
                            sebagai penanggung jawab atau pengelola pada fasilitas
                            <strong>{{ $petugas->fasilitas->nama_fasilitas }}</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection