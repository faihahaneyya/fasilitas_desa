@extends('layouts.guest.app')

@section('title', 'Daftar Petugas Fasilitas')

@section('content')
    <div class="container-fluid pt-5">
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-people me-2 text-primary"></i> Daftar Petugas Fasilitas
                </h5>
                <a href="{{ route('petugas.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Petugas
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                @forelse ($petugas as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-info text-dark rounded-pill px-3">
                                        <i class="bi bi-building me-1"></i> {{ $item->fasilitas->nama_fasilitas }}
                                    </span>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-circle bg-primary text-white me-3 d-flex align-items-center justify-content-center rounded-circle"
                                        style="width: 50px; height: 50px;">
                                        <i class="bi bi-person-circle fs-3"></i>
                                    </div>
                                    <div style="flex: 1;">
                                        <h6 class="mb-0 fw-bold text-truncate" style="max-width: 150px;">
                                            {{ $item->warga->nama }}</h6>
                                        <small class="text-muted d-block">NIK: {{ $item->warga->no_ktp }}</small>
                                    </div>
                                </div>

                                <div class="bg-light p-2 rounded mb-1">
                                    <small class="text-muted d-block fw-bold"
                                        style="font-size: 0.7rem; text-transform: uppercase;">Peran:</small>
                                    <span class="text-dark fw-medium">{{ $item->peran }}</span>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-top-0 pb-3 pt-0">
                                <div class="row g-2">
                                    <div class="col-4">
                                        <a href="{{ route('petugas.show', $item->petugas_id) }}"
                                            class="btn btn-outline-info btn-sm w-100 py-2">
                                            <i class="bi bi-eye d-block mb-1"></i> Detail
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="{{ route('petugas.edit', $item->petugas_id) }}"
                                            class="btn btn-outline-warning btn-sm w-100 py-2">
                                            <i class="bi bi-pencil d-block mb-1"></i> Edit
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <form action="{{ route('petugas.destroy', $item->petugas_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100 py-2">
                                                <i class="bi bi-trash d-block mb-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="card border-0 shadow-sm py-5">
                            <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
                            <p class="text-muted">Belum ada data petugas fasilitas.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($petugas->hasPages())
                <div class="mt-5 d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <p class="text-muted small mb-3 mb-md-0">
                        Menampilkan <strong>{{ $petugas->firstItem() }}</strong> - <strong>{{ $petugas->lastItem() }}</strong>
                        dari <strong>{{ $petugas->total() }}</strong> petugas
                    </p>
                    <div>
                        {{ $petugas->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection