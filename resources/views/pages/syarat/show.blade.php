@extends('layouts.guest.app')

@section('title', 'Detail Syarat Fasilitas')

@section('content')
    <div class="container py-5">
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-file-earmark-text me-2 text-primary"></i> Detail Syarat Fasilitas
                </h5>
                <div>
                    <a href="{{ route('syarat.edit', $syarat->syarat_id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('syarat.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    {{-- Kolom Kiri: Detail Teks --}}
                    <div class="col-md-7">
                        <table class="table table-borderless">
                            <tr>
                                <th width="180">Fasilitas Terkait</th>
                                <td>: <span
                                        class="badge bg-info text-dark">{{ $syarat->fasilitas->name ?? $syarat->fasilitas_id }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Syarat</th>
                                <td>: <span class="fw-bold">{{ $syarat->nama_syarat }}</span></td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td>: {{ $syarat->created_at->format('d F Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Update Terakhir</th>
                                <td>: {{ $syarat->updated_at->format('d F Y, H:i') }}</td>
                            </tr>
                        </table>

                        <div class="mt-4 p-3 bg-light rounded border">
                            <h6 class="fw-bold"><i class="bi bi-info-circle me-2"></i>Deskripsi / Keterangan:</h6>
                            <hr class="my-2">
                            <p class="mb-0 text-muted">
                                {{ $syarat->deskripsi ?: 'Tidak ada deskripsi tambahan untuk syarat ini.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Gambar Contoh --}}
                    <div class="col-md-5">
                        <div class="border rounded p-2 bg-white shadow-sm text-center">
                            <h6 class="fw-bold text-start ps-2 pt-2 mb-3">Contoh Gambar:</h6>
                            @if($syarat->media)
                                <a href="{{ asset('storage/' . $syarat->media->file_name) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $syarat->media->file_name) }}"
                                        class="img-fluid rounded border" style="max-height: 400px; object-fit: contain;"
                                        alt="Gambar Syarat">
                                </a>
                                <div class="mt-2">
                                    <small class="text-muted italic">Klik gambar untuk memperbesar</small>
                                </div>
                            @else
                                <div class="py-5 bg-light rounded border d-flex flex-column align-items-center">
                                    <i class="bi bi-image text-muted display-4"></i>
                                    <p class="text-muted mt-2">Tidak ada gambar contoh</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection