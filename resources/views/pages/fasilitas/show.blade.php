@extends('layouts.guest.app')

@section('title', 'Detail Fasilitas')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-building text-success me-2"></i> Detail Fasilitas
                        </h5>
                        <div class="btn-group" role="group">
                            <a href="{{ route('fasilitas.edit', $fasilitas->fasilitas_id) }}"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Detail Information -->
                        <div class="mb-4">
                            <h6 class="fw-bold">{{ $fasilitas->name }}</h6>
                            <span class="badge bg-{{ $fasilitas->jenis_color }} mb-2">
                                {{ $fasilitas->jenis }}
                            </span>
                        </div>

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="120">Alamat</th>
                                        <td>: {{ $fasilitas->alamat }}</td>
                                    </tr>
                                    @if($fasilitas->rt || $fasilitas->rw)
                                        <tr>
                                            <th>RT/RW</th>
                                            <td>:
                                                @if($fasilitas->rt) RT {{ $fasilitas->rt }} @endif
                                                @if($fasilitas->rw) / RW {{ $fasilitas->rw }} @endif
                                            </td>
                                        </tr>
                                    @endif
                                    @if($fasilitas->kapasitas)
                                        <tr>
                                            <th>Kapasitas</th>
                                            <td>: {{ number_format($fasilitas->kapasitas) }} orang</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="120">Dibuat</th>
                                        <td>: {{ $fasilitas->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Diupdate</th>
                                        <td>: {{ $fasilitas->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- ======================== -->
                        <!-- GALERI FOTO FASILITAS -->
                        <!-- ======================== -->
                        @if($fasilitas->media->count() > 0)
                            <div class="mt-4">
                                <h6 class="fw-bold mb-3">Galeri Foto</h6>
                                <div class="row g-3">
                                    @foreach($fasilitas->media as $media)
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="card border h-100">
                                                <a href="{{ $media->file_url }}" data-fancybox="gallery"
                                                    data-caption="{{ $media->caption ?? 'Foto Fasilitas' }}">
                                                    <img src="{{ $media->file_url }}"
                                                        alt="{{ $media->caption ?? 'Foto Fasilitas' }}" class="card-img-top"
                                                        style="height: 150px; object-fit: cover;">
                                                </a>
                                                @if($media->caption)
                                                    <div class="card-body p-2">
                                                        <p class="card-text small mb-0">{{ $media->caption }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Deskripsi -->
                        @if($fasilitas->deskripsi)
                            <div class="mt-4">
                                <h6 class="fw-bold mb-2">Deskripsi</h6>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <p class="mb-0">{{ $fasilitas->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
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
            transition: transform 0.3s;
        }

        .card-img-top:hover {
            transform: scale(1.05);
        }
    </style>
@endpush

@push('scripts')
    <!-- Fancybox untuk lightbox gallery -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {
            // Options
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
    </script>
@endpush