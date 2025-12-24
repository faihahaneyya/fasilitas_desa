@extends('layouts.guest.app')

@section('title', 'Fasilitas Umum')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-building text-success me-2"></i> Fasilitas Umum
                </h4>
                <p class="text-muted mb-0">Total: {{ $fasilitas->total() }} fasilitas</p>
            </div>
            <a href="{{ route('fasilitas.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i> Tambah Fasilitas
            </a>
        </div>

        <form method="GET" action="{{ route('fasilitas.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <select name="jenis" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Jenis Fasilitas --</option>
                        @php
                            $list_jenis = ['Aula', 'Lapangan Sepak Bola', 'Lapangan Bulutangkis', 'Pos Kamling', 'Masjid', 'Musholla', 'Taman Bermain'];
                        @endphp
                        @foreach($list_jenis as $j)
                            <option value="{{ $j }}" {{ request('jenis') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Cari nama atau alamat...">
                        <button type="submit" class="btn btn-primary">
                            <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        @if(request('search') || request('jenis'))
                            <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-danger">Clear</a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Fasilitas Cards -->
    <div class="row">
        @forelse ($fasilitas as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <!-- Card Header -->
                    <div class="card-header bg-white border-bottom-0 pb-0">
                        <div class="d-flex justify-content-between align-items-start">
                            <h6 class="fw-bold mb-1">{{ $item->name }}</h6>
                            <span class="badge bg-{{ $item->jenis_color }}">
                                {{ $item->jenis }}
                            </span>
                        </div>
                        <small class="text-muted">
                            <i class="bi bi-geo-alt me-1"></i> {{ $item->lokasi }}
                        </small>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body pt-2">
                        @if($item->kapasitas)
                            <div class="mb-2">
                                <i class="bi bi-people text-muted me-2"></i>
                                <span>Kapasitas: {{ number_format($item->kapasitas) }} orang</span>
                            </div>
                        @endif

                        @if($item->deskripsi)
                            <div class="mb-2">
                                <i class="bi bi-card-text text-muted me-2"></i>
                                <span class="text-truncate d-inline-block" style="max-width: 100%;">
                                    {{ Str::limit($item->deskripsi, 100) }}
                                </span>
                            </div>
                        @endif

                        <div class="small text-muted">
                            <i class="bi bi-calendar me-1"></i>
                            Dibuat: {{ $item->created_at->format('d/m/Y') }}
                        </div>
                    </div>

                    <!-- Card Footer dengan Tombol Aksi -->
                    <div class="card-footer bg-white border-top-0 pt-0">
                        <div class="d-flex justify-content-end gap-2">
                            <!-- Show Button -->
                            <a href="{{ route('fasilitas.show', $item->fasilitas_id) }}" class="btn btn-sm btn-outline-info"
                                title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('fasilitas.edit', $item->fasilitas_id) }}" class="btn btn-sm btn-outline-warning"
                                title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('fasilitas.destroy', $item->fasilitas_id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus fasilitas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-building display-1 text-muted"></i>
                        </div>
                        <h5 class="text-muted mb-3">Belum ada data fasilitas</h5>
                        <a href="{{ route('fasilitas.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Fasilitas Pertama
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    <div class="mt-3">
        {{ $fasilitas->links('pagination::bootstrap-5') }}
    </div>
    </div>

    <style>
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

        .badge {
            font-size: 0.75em;
        }
    </style>
@endsection