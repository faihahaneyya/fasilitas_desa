@extends('layouts.guest.app')

@section('title', 'Tambah Petugas Fasilitas')

@section('content')
    <div class="vh-100 pt-5">
        <div class="card mt-5 border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-person-plus me-2 text-primary"></i> Tambah Petugas Fasilitas
                </h5>
            </div>

            <div class="card-body">
                <form action="{{ route('petugas.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fasilitas_id" class="form-label">Fasilitas <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('fasilitas_id') is-invalid @enderror" id="fasilitas_id"
                                name="fasilitas_id">
                                <option value="">-- Pilih Fasilitas --</option>
                                @foreach ($fasilitas as $f)
                                    <option value="{{ $f->fasilitas_id }}" {{ old('fasilitas_id') == $f->fasilitas_id ? 'selected' : '' }}>
                                        {{ $f->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fasilitas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="petugas_warga_id" class="form-label">Nama Petugas (Warga) <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('petugas_warga_id') is-invalid @enderror"
                                id="petugas_warga_id" name="petugas_warga_id">
                                <option value="">-- Pilih Warga --</option>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}" {{ old('petugas_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }} ({{ $w->no_ktp }})
                                    </option>
                                @endforeach
                            </select>
                            @error('petugas_warga_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="peran" class="form-label">Peran / Jabatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('peran') is-invalid @enderror" id="peran" name="peran"
                            value="{{ old('peran') }}" placeholder="Contoh: Ketua Pengelola, Keamanan, atau Kebersihan">
                        @error('peran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('petugas.index') }}" class="btn btn-secondary me-md-2">
                            <i class="bi bi-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i> Simpan Petugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection