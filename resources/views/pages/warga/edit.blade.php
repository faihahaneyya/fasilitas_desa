@extends('layouts.guest.app')

@section('title', 'Edit Warga')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="bi bi-pencil me-2"></i> Edit Data Warga
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="no_ktp" class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp"
                            name="no_ktp" value="{{ old('no_ktp', $warga->no_ktp) }}">
                        @error('no_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" value="{{ old('nama', $warga->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                            name="jenis_kelamin">
                            <option value="L"
                                {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="P"
                                {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                        <select class="form-select @error('agama') is-invalid @enderror" id="agama" name="agama">
                            @foreach ($agama as $item)
                                <option value="{{ $item }}"
                                    {{ old('agama', $warga->agama) == $item ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                        <select class="form-select @error('pekerjaan') is-invalid @enderror" id="pekerjaan"
                            name="pekerjaan">
                            @foreach ($pekerjaan as $item)
                                <option value="{{ $item }}"
                                    {{ old('pekerjaan', $warga->pekerjaan) == $item ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="telp" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp"
                            name="telp" value="{{ old('telp', $warga->telp) }}">
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $warga->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('warga.index') }}" class="btn btn-secondary me-md-2">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-2"></i> Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
