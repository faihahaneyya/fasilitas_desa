@extends('layouts.guest.app')

@section('title', 'Data Warga')

@section('content')
    <div class="container-fluid">
        <!-- Header dengan Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <div>
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-people-fill text-success me-2"></i> Data Warga
                </h4>
                <p class="text-muted mb-0">Total: {{ $warga->total() }} warga</p>
            </div>
            <a href="{{ route('warga.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i> Tambah Warga
            </a>
        </div>
            <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-2">
                        <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                            <option value="" selected>Semua</option>
                            <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                value="{{request('search')}}" placeholder="Search" aria-label="Search">
                            <button type="submit" class="input-group-text" id="basic-addon2">
                                <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            @if(request('search'))
							<a href="{{ request()->fullUrlWithQuery(['search'=> null]) }}" class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
					        @endif
                        </div>
                    </div>
                </div>
            </form>
        <!-- Data Warga dalam Card Grid -->
        <div class="row">
            @forelse ($warga as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <!-- Card Header dengan Nama -->
                        <div class="card-header bg-white border-bottom-0 pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="fw-bold mb-1">{{ $item->nama }}</h6>
                                <span class="badge {{ $item->jenis_kelamin == 'L' ? 'bg-primary' : 'bg-danger' }} badge-sm">
                                    {{ $item->jenis_kelamin_formatted }}
                                </span>
                            </div>
                            <small class="text-muted">NIK: {{ $item->no_ktp }}</small>
                        </div>

                        <!-- Card Body dengan Informasi -->
                        <div class="card-body pt-2">
                            <div class="mb-2">
                                <i class="bi bi-person-badge text-muted me-2"></i>
                                <span>{{ $item->agama }}</span>
                            </div>
                            <div class="mb-2">
                                <i class="bi bi-briefcase text-muted me-2"></i>
                                <span>{{ $item->pekerjaan }}</span>
                            </div>
                            @if ($item->telp)
                                <div class="mb-2">
                                    <i class="bi bi-telephone text-muted me-2"></i>
                                    <span>{{ $item->telp }}</span>
                                </div>
                            @endif
                            @if ($item->email)
                                <div>
                                    <i class="bi bi-envelope text-muted me-2"></i>
                                    <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                        {{ $item->email }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer dengan Tombol Aksi -->
                        <div class="card-footer bg-white border-top-0 pt-0">
                            <div class="d-flex justify-content-end">
                                <!-- Show Button -->
                                <a href="{{ route('warga.show', $item->warga_id) }}" class="btn btn-sm btn-outline-info me-2"
                                    title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-sm btn-outline-warning me-2"
                                    title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus data warga ini?')">
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
                                <i class="bi bi-people display-1 text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-3">Belum ada data warga</h5>
                            <a href="{{ route('warga.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle me-2"></i> Tambah Warga Pertama
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $warga->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <style>
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
    </style>
@endsection