@extends('layouts.guest.app')

@section('title', 'Ajukan Peminjaman')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="bi bi-calendar-plus text-success me-2"></i> Ajukan Peminjaman Fasilitas
                        </h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('peminjaman.store') }}" method="POST" id="peminjamanForm" enctype="multipart/form-data">
                            @csrf

                            <!-- Pilih Fasilitas -->
                            <div class="mb-3">
                                <label for="fasilitas_id" class="form-label">Pilih Fasilitas <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('fasilitas_id') is-invalid @enderror" id="fasilitas_id"
                                    name="fasilitas_id" required>
                                    <option value="">Pilih Fasilitas</option>
                                    @foreach ($fasilitas as $fas)
                                        <option value="{{ $fas->fasilitas_id }}"
                                            {{ old('fasilitas_id') == $fas->fasilitas_id ? 'selected' : '' }}>
                                            {{ $fas->name }} ({{ $fas->jenis }}) - {{ $fas->lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fasilitas_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pilih Peminjam -->
                            <div class="mb-3">
                                <label for="warga_id" class="form-label">Pilih Peminjam <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('warga_id') is-invalid @enderror" id="warga_id"
                                    name="warga_id" required>
                                    <option value="">Pilih Warga</option>
                                    @foreach ($warga as $w)
                                        <option value="{{ $w->warga_id }}"
                                            {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} (NIK: {{ $w->no_ktp }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('warga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Tanggal Mulai -->
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                        id="tanggal_mulai" name="tanggal_mulai"
                                        value="{{ old('tanggal_mulai', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}"
                                        required onchange="hitungDurasi()">
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Selesai -->
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span
                                            class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                        id="tanggal_selesai" name="tanggal_selesai"
                                        value="{{ old('tanggal_selesai', date('Y-m-d')) }}" required
                                        onchange="hitungDurasi()">
                                    @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Durasi (otomatis) -->
                            <div class="mb-3">
                                <label class="form-label">Durasi Peminjaman</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-info text-white">
                                        <i class="bi bi-calendar-range"></i>
                                    </span>
                                    <input type="text" class="form-control bg-light" id="durasiDisplay" value="0 hari"
                                        readonly>
                                    <span class="input-group-text">
                                        Hari
                                    </span>
                                </div>
                                <small class="text-muted">Durasi otomatis dihitung dari tanggal mulai dan selesai</small>
                            </div>

                            <!-- Tujuan -->
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Tujuan Peminjaman <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('tujuan') is-invalid @enderror" id="tujuan" name="tujuan" rows="3"
                                    required>{{ old('tujuan') }}</textarea>
                                @error('tujuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Total Biaya -->
                            <div class="mb-3">
                                <label for="total_biaya" class="form-label">Total Biaya (Rp) <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('total_biaya') is-invalid @enderror"
                                    id="total_biaya" name="total_biaya" value="{{ old('total_biaya', 0) }}" required>
                                @error('total_biaya')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Catatan -->
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan (opsional)</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="2">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ======================== -->
                            <!-- UPLOAD DOKUMEN PENDUKUNG KE TABLE MEDIA -->
                            <!-- ======================== -->
                            <div class="mb-4">
                                <label for="dokumen_files" class="form-label fw-bold">
                                    Dokumen Pendukung <span class="text-muted small">(Multiple Upload)</span>
                                </label>
                                <input type="file"
                                    class="form-control @error('dokumen_files.*') is-invalid @enderror"
                                    id="dokumen_files"
                                    name="dokumen_files[]"
                                    multiple
                                    accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">

                                @error('dokumen_files.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <div class="form-text">
                                    Format: JPG, PNG, PDF, DOCX, XLSX. Maks: 5MB/file.
                                </div>

                                <div id="dokumen-preview-container" class="mt-3 row g-2 d-none">
                                    <div class="col-12">
                                        <p class="text-muted small mb-2 fw-bold">Preview Gambar:</p>
                                    </div>
                                    </div>

                                <div id="dokumen-deskripsi-container" class="mt-3 d-none">
                                    <p class="text-muted small mb-2 fw-bold">Keterangan Dokumen (Opsional):</p>
                                    <div id="description-inputs"></div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-send me-2"></i> Ajukan Peminjaman
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menghitung durasi
        function hitungDurasi() {
            const tanggalMulai = document.getElementById('tanggal_mulai');
            const tanggalSelesai = document.getElementById('tanggal_selesai');
            const durasiDisplay = document.getElementById('durasiDisplay');

            // Reset error
            tanggalSelesai.classList.remove('is-invalid');

            if (tanggalMulai.value && tanggalSelesai.value) {
                const start = new Date(tanggalMulai.value);
                const end = new Date(tanggalSelesai.value);

                // Validasi tanggal selesai harus >= tanggal mulai
                if (end < start) {
                    durasiDisplay.value = 'Tanggal tidak valid!';
                    durasiDisplay.classList.add('text-danger');
                    tanggalSelesai.classList.add('is-invalid');
                    return;
                }

                // Hitung selisih hari
                const diffTime = end.getTime() - start.getTime();
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // +1 untuk inklusif

                // Tampilkan durasi
                durasiDisplay.value = diffDays + ' hari';
                durasiDisplay.classList.remove('text-danger');

                // Set min untuk tanggal selesai
                tanggalSelesai.min = tanggalMulai.value;
            } else {
                durasiDisplay.value = '0 hari';
            }
        }

        document.getElementById('dokumen_files').addEventListener('change', function(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('dokumen-preview-container');
    const descContainer = document.getElementById('dokumen-deskripsi-container');
    const descInputs = document.getElementById('description-inputs');

    // Reset konten sebelumnya
    previewContainer.innerHTML = '<div class="col-12"><p class="text-muted small mb-2 fw-bold">Preview Gambar:</p></div>';
    descInputs.innerHTML = '';
    
    if (files.length > 0) {
        previewContainer.classList.remove('d-none');
        descContainer.classList.remove('d-none');

        Array.from(files).forEach((file, index) => {
            // 1. Buat Input Deskripsi untuk setiap file
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-2';
            inputGroup.innerHTML = `
                <span class="input-group-text small">File ${index + 1}</span>
                <input type="text" name="captions[]" class="form-control form-control-sm" 
                       placeholder="Masukkan keterangan untuk ${file.name}">
            `;
            descInputs.appendChild(inputGroup);

            // 2. Buat Preview jika file adalah gambar
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-4 col-md-2';
                    col.innerHTML = `
                        <div class="card h-100 shadow-sm">
                            <img src="${e.target.result}" class="card-img-top" style="height: 80px; object-fit: cover;">
                            <div class="card-footer p-1">
                                <p class="text-truncate small mb-0" style="font-size: 10px;">${file.name}</p>
                            </div>
                        </div>
                    `;
                    previewContainer.appendChild(col);
                }
                reader.readAsDataURL(file);
            } else {
                // Jika bukan gambar (misal PDF), tampilkan ikon saja
                const col = document.createElement('div');
                col.className = 'col-4 col-md-2';
                col.innerHTML = `
                    <div class="card h-100 shadow-sm text-center p-2 bg-light">
                        <i class="bi bi-file-earmark-text fs-2 text-secondary"></i>
                        <p class="text-truncate small mb-0 mt-1" style="font-size: 10px;">${file.name}</p>
                    </div>
                `;
                previewContainer.appendChild(col);
            }
        });
    } else {
        previewContainer.classList.add('d-none');
        descContainer.classList.add('d-none');
    }
});

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            hitungDurasi();

            // Format tanggal ke format Indonesia
            function formatTanggalIndonesia(date) {
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                const d = new Date(date);
                return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
            }

            // Tampilkan tanggal dalam format yang lebih baik
            const tanggalMulai = document.getElementById('tanggal_mulai');
            const tanggalSelesai = document.getElementById('tanggal_selesai');

            tanggalMulai.addEventListener('change', function() {
                // Update tanggal selesai min
                tanggalSelesai.min = this.value;

                // Jika tanggal selesai lebih kecil dari tanggal mulai, update
                if (tanggalSelesai.value && new Date(tanggalSelesai.value) < new Date(this.value)) {
                    tanggalSelesai.value = this.value;
                }

                hitungDurasi();
            });

            tanggalSelesai.addEventListener('change', hitungDurasi);

            // Format biaya dengan titik setiap 3 digit
            const totalBiaya = document.getElementById('total_biaya');
            totalBiaya.addEventListener('blur', function() {
                const value = parseInt(this.value.replace(/\D/g, '') || 0);
                this.value = value.toLocaleString('id-ID');
            });

            // Saat form di-submit, hilangkan format titik
            document.getElementById('peminjamanForm').addEventListener('submit', function(e) {
                // Hapus titik dari biaya
                if (totalBiaya.value.includes('.')) {
                    totalBiaya.value = totalBiaya.value.replace(/\./g, '');
                }

                // Validasi tanggal
                if (tanggalMulai.value && tanggalSelesai.value) {
                    const start = new Date(tanggalMulai.value);
                    const end = new Date(tanggalSelesai.value);

                    if (end < start) {
                        e.preventDefault();
                        alert('Tanggal selesai harus setelah tanggal mulai!');
                        tanggalSelesai.focus();
                    }
                }

                // Validasi file size (maksimal 5MB per file)
                const dokumenFiles = document.getElementById('dokumen_files').files;
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes

                for (let i = 0; i < dokumenFiles.length; i++) {
                    if (dokumenFiles[i].size > maxSize) {
                        e.preventDefault();
                        alert(`File "${dokumenFiles[i].name}" melebihi ukuran maksimal 5MB!`);
                        return;
                    }
                }
            });
        });
    </script>

    <style>
        .is-invalid {
            border-color: #dc3545 !important;
        }

        #durasiDisplay {
            font-weight: 600;
            text-align: center;
        }

        .input-group-text {
            font-weight: 500;
        }

        #dokumen-preview-container img {
            object-fit: cover;
            border: 1px solid #dee2e6;
        }

        #dokumen-preview-container .bi-file-earmark-text {
            font-size: 3rem;
        }
    </style>
@endsection
