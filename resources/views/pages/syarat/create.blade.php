@extends('layouts.guest.app')

@section('title', 'Tambah Syarat Fasilitas')

@section('content')
    <div class="vh-100 pt-5">
        <div class="card mt-5 border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-file-earmark-plus me-2 text-success"></i> Tambah Syarat Fasilitas
                </h5>
            </div>

            <div class="card-body">
                <form action="{{ route('syarat.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fasilitas_id" class="form-label">Fasilitas <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('fasilitas_id') is-invalid @enderror" id="fasilitas_id"
                                name="fasilitas_id">
                                <option value="">Pilih Fasilitas</option>
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
                            <label for="nama_syarat" class="form-label">Nama Syarat <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_syarat') is-invalid @enderror"
                                id="nama_syarat" name="nama_syarat" value="{{ old('nama_syarat') }}"
                                placeholder="Contoh: Fotokopi KTP">
                            @error('nama_syarat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi Syarat</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                            name="deskripsi" rows="4"
                            placeholder="Jelaskan detail syarat di sini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('syarat.index') }}" class="btn btn-secondary me-md-2">
                            <i class="bi bi-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-2"></i> Simpan Syarat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection