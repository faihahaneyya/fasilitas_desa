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
                        <a href="{{ route('fasilitas.edit', $fasilita->fasilitas_id) }}"
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
                        <h6 class="fw-bold">{{ $fasilita->name }}</h6>
                        <span class="badge bg-{{ $fasilita->jenis_color }} mb-2">
                            {{ $fasilita->jenis }}
                        </span>
                    </div>

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="120">Alamat</th>
                                    <td>: {{ $fasilita->alamat }}</td>
                                </tr>
                                @if($fasilita->rt || $fasilita->rw)
                                <tr>
                                    <th>RT/RW</th>
                                    <td>:
                                        @if($fasilita->rt) RT {{ $fasilita->rt }} @endif
                                        @if($fasilita->rw) / RW {{ $fasilita->rw }} @endif
                                    </td>
                                </tr>
                                @endif
                                @if($fasilita->kapasitas)
                                <tr>
                                    <th>Kapasitas</th>
                                    <td>: {{ number_format($fasilita->kapasitas) }} orang</td>
                                </tr>
                                @endif
                            </table>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="120">Dibuat</th>
                                    <td>: {{ $fasilita->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diupdate</th>
                                    <td>: {{ $fasilita->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    @if($fasilita->deskripsi)
                    <div class="mt-4">
                        <h6 class="fw-bold mb-2">Deskripsi</h6>
                        <div class="card bg-light">
                            <div class="card-body">
                                <p class="mb-0">{{ $fasilita->deskripsi }}</p>
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
