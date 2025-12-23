@extends('layouts.guest.app')

@section('title', 'Detail Syarat Fasilitas')

@section('content')
    <div class="card border-0 shadow-sm">
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
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="180">Fasilitas Terkait</th>
                            <td>: <span class="badge bg-info text-dark">{{ $syarat->fasilitas->nama_fasilitas }}</span></td>
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
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light rounded shadow-sm border">
                        <h6 class="fw-bold"><i class="bi bi-info-circle me-2"></i>Deskripsi / Keterangan:</h6>
                        <hr class="my-2">
                        <p class="mb-0 text-muted">
                            {{ $syarat->deskripsi ?: 'Tidak ada deskripsi tambahan untuk syarat ini.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection