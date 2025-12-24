@extends('layouts.guest.app')

@section('title', 'Syarat Fasilitas')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <div>
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-file-earmark-text-fill text-success me-2"></i> Syarat Fasilitas
                </h4>
                <p class="text-muted mb-0">Total: {{ $syarat->total() }} data</p>
            </div>
            <a href="{{ route('syarat.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i> Tambah Syarat
            </a>
        </div>
        <form method="GET" action="{{ route('syarat.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <select name="fasilitas_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Fasilitas --</option>
                        @foreach($list_fasilitas as $fasilitas)
                            <option value="{{ $fasilitas->fasilitas_id }}" {{ request('fasilitas_id') == $fasilitas->fasilitas_id ? 'selected' : '' }}>
                                {{ $fasilitas->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Cari syarat atau fasilitas...">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        @if(request('search') || request('fasilitas_id'))
                            <a href="{{ route('syarat.index') }}" class="btn btn-outline-danger">Reset</a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            @forelse ($syarat as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        {{-- Bagian Gambar Contoh --}}
                        <div class="position-relative">
                            @if($item->media)
                                <img src="{{ asset('storage/' . $item->media->file_name) }}" class="card-img-top"
                                    style="height: 160px; object-fit: cover; border-radius: 10px 10px 0 0;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                    style="height: 160px; border-radius: 10px 10px 0 0;">
                                    <i class="bi bi-image text-muted fs-1"></i>
                                </div>
                            @endif
                            <span class="badge bg-info position-absolute top-0 end-0 m-2">
                                {{ $item->fasilitas->name ?? 'ID: ' . $item->fasilitas_id }}
                            </span>
                        </div>

                        <div class="card-header bg-white border-bottom-0 pb-0 mt-2">
                            <h6 class="fw-bold mb-1 text-truncate">{{ $item->nama_syarat }}</h6>
                            <small class="text-muted">ID Syarat: #{{ $item->syarat_id }}</small>
                        </div>

                        <div class="card-body pt-2">
                            <div class="mb-2">
                                <p class="small mb-0 text-secondary"
                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $item->deskripsi ?? 'Tidak ada deskripsi' }}
                                </p>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top-0 pt-0">
                            <div class="d-flex justify-content-end pb-3">
                                <a href="{{ route('syarat.show', $item->syarat_id) }}" class="btn btn-sm btn-outline-info me-2">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('syarat.edit', $item->syarat_id) }}"
                                    class="btn btn-sm btn-outline-warning me-2">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('syarat.destroy', $item->syarat_id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus syarat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-journal-x display-1 text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-3">Belum ada data syarat fasilitas</h5>
                            <a href="{{ route('syarat.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle me-2"></i> Tambah Syarat Pertama
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($syarat->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
                <div class="text-muted">
                    <small>
                        Menampilkan {{ ($syarat->currentPage() - 1) * $syarat->perPage() + 1 }}
                        sampai {{ min($syarat->currentPage() * $syarat->perPage(), $syarat->total()) }}
                        dari {{ $syarat->total() }} data
                    </small>
                </div>

                <div class="mt-3">
                    {{ $syarat->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>

    <style>
        /* ... (Gunakan CSS yang sama dari file Warga Anda) ... */
        .badge-sm {
            font-size: 0.75em;
            padding: 0.25em 0.5em;
        }

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

        /* Pagination CSS sesuai file asli */
    </style>
@endsection