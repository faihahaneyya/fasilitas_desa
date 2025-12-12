@extends('layouts.guest.app')

@section('title', 'Edit Pembayaran')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-pencil-square text-warning me-2"></i> Edit Pembayaran
                </h4>
                <p class="text-muted mb-0">ID: #{{ $pembayaran->bayar_id }}</p>
            </div>
            <a href="{{ route('pembayaran-fasilitas.show', $pembayaran->bayar_id) }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <!-- Form Container -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 pb-3">
                        <h5 class="fw-bold mb-0">Informasi Pembayaran</h5>
                        <p class="text-muted mb-0 small">Perbarui data pembayaran di bawah ini</p>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('pembayaran-fasilitas.update', $pembayaran->bayar_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <!-- Peminjaman -->
                                    <div class="mb-3">
                                        <label for="pinjam_id" class="form-label fw-semibold">
                                            <i class="bi bi-link-45deg text-muted me-2"></i>ID Peminjaman
                                        </label>
                                        <select name="pinjam_id" id="pinjam_id"
                                            class="form-select @error('pinjam_id') is-invalid @enderror" required>
                                            @foreach ($peminjaman as $p)
                                                <option value="{{ $p->pinjam_id }}"
                                                    {{ $pembayaran->pinjam_id == $p->pinjam_id ? 'selected' : '' }}>
                                                    Peminjaman #{{ $p->pinjam_id }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pinjam_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Tanggal -->
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label fw-semibold">
                                            <i class="bi bi-calendar text-muted me-2"></i>Tanggal Pembayaran
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal"
                                            value="{{ old('tanggal', $pembayaran->tanggal->format('Y-m-d')) }}"
                                            class="form-control @error('tanggal') is-invalid @enderror" required>
                                        @error('tanggal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <!-- Jumlah -->
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label fw-semibold">
                                            <i class="bi bi-cash text-muted me-2"></i>Jumlah Pembayaran
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="jumlah" id="jumlah"
                                                value="{{ old('jumlah', $pembayaran->jumlah) }}" step="0.01"
                                                min="0" class="form-control @error('jumlah') is-invalid @enderror"
                                                required>
                                            @error('jumlah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Metode -->
                                    <div class="mb-3">
                                        <label for="metode" class="form-label fw-semibold">
                                            <i class="bi bi-credit-card text-muted me-2"></i>Metode Pembayaran
                                        </label>
                                        <select name="metode" id="metode"
                                            class="form-select @error('metode') is-invalid @enderror" required>
                                            <option value="tunai" {{ $pembayaran->metode == 'tunai' ? 'selected' : '' }}>
                                                Tunai</option>
                                            <option value="transfer"
                                                {{ $pembayaran->metode == 'transfer' ? 'selected' : '' }}>Transfer Bank
                                            </option>
                                            <option value="kartu_kredit"
                                                {{ $pembayaran->metode == 'kartu_kredit' ? 'selected' : '' }}>Kartu Kredit
                                            </option>
                                            <option value="debit" {{ $pembayaran->metode == 'debit' ? 'selected' : '' }}>
                                                Kartu Debit</option>
                                            <option value="qris" {{ $pembayaran->metode == 'qris' ? 'selected' : '' }}>
                                                QRIS</option>
                                            <option value="lainnya"
                                                {{ $pembayaran->metode == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('metode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-4">
                                <label for="keterangan" class="form-label fw-semibold">
                                    <i class="bi bi-card-text text-muted me-2"></i>Keterangan (Opsional)
                                </label>
                                <textarea name="keterangan" id="keterangan" rows="4"
                                    class="form-control @error('keterangan') is-invalid @enderror"
                                    placeholder="Catatan tambahan tentang pembayaran ini">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Current Info -->
                            <div class="alert alert-info border-0 bg-light mb-4">
                                <div class="d-flex">
                                    <i class="bi bi-info-circle-fill text-info me-3 mt-1"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">Informasi Saat Ini</h6>
                                        <p class="mb-0 small">
                                            Pembayaran ini dibuat pada {{ $pembayaran->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between border-top pt-4 mt-3">
                                <div>
                                    <a href="{{ route('pembayaran-fasilitas.show', $pembayaran->bayar_id) }}"
                                        class="btn btn-outline-secondary">
                                        <i class="bi bi-x-circle me-2"></i> Batal
                                    </a>
                                    <a href="{{ route('pembayaran-fasilitas.show', $pembayaran->bayar_id) }}"
                                        class="btn btn-outline-info ms-2">
                                        <i class="bi bi-eye me-2"></i> Lihat Detail
                                    </a>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i> Update Pembayaran
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-label {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .card {
            border-radius: 12px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
@endsection
