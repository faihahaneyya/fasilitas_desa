@extends('layouts.guest.app')

@section('title', 'Edit Peminjaman')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="bi bi-pencil text-success me-2"></i> Edit Data Peminjaman
                        </h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('peminjaman.update', $peminjaman->pinjam_id) }}" method="POST"
                            id="peminjamanForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Status Peminjaman -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Peminjaman <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    @foreach ($statusOptions as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('status', $peminjaman->status) == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pilih Fasilitas -->
                            <div class="mb-3">
                                <label for="fasilitas_id" class="form-label">Pilih Fasilitas <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('fasilitas_id') is-invalid @enderror" id="fasilitas_id"
                                    name="fasilitas_id" required>
                                    <option value="">Pilih Fasilitas</option>
                                    @foreach ($fasilitas as $fas)
                                        <option value="{{ $fas->fasilitas_id }}"
                                            {{ old('fasilitas_id', $peminjaman->fasilitas_id) == $fas->fasilitas_id ? 'selected' : '' }}>
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
                                            {{ old('warga_id', $peminjaman->warga_id) == $w->warga_id ? 'selected' : '' }}>
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
                                        value="{{ old('tanggal_mulai', $peminjaman->tanggal_mulai->format('Y-m-d')) }}"
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
                                        value="{{ old('tanggal_selesai', $peminjaman->tanggal_selesai->format('Y-m-d')) }}"
                                        required onchange="hitungDurasi()">
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
                                    required>{{ old('tujuan', $peminjaman->tujuan) }}</textarea>
                                @error('tujuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Total Biaya -->
                            <div class="mb-3">
                                <label for="total_biaya" class="form-label">Total Biaya (Rp) <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('total_biaya') is-invalid @enderror"
                                    id="total_biaya" name="total_biaya"
                                    value="{{ old('total_biaya', $peminjaman->total_biaya) }}" required>
                                @error('total_biaya')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Catatan -->
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan (opsional)</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="2">{{ old('catatan', $peminjaman->catatan) }}</textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ======================== -->
                            <!-- DOKUMEN PENDUKUNG YANG SUDAH DIUPLOAD -->
                            <!-- ======================== -->
                            @if($peminjaman->media && $peminjaman->media->count() > 0)
                                <div class="mb-4">
                                    <label class="form-label">Dokumen Pendukung Terupload</label>
                                    <div class="row g-2">
                                        @foreach($peminjaman->media as $media)
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card border">
                                                    <div class="card-body p-2">
                                                        <div class="d-flex align-items-center">
                                                            @if($media->is_image)
                                                                <img src="{{ $media->getUrl() }}"
                                                                     alt="Preview"
                                                                     class="img-thumbnail me-2"
                                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                                            @else
                                                                <div class="bg-light rounded p-2 me-2">
                                                                    <i class="bi bi-file-earmark-text text-primary fs-4"></i>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <small class="d-block text-truncate" style="max-width: 150px;">
                                                                    {{ $media->file_name }}
                                                                </small>
                                                                <small class="text-muted">
                                                                    {{ number_format($media->size / 1024, 2) }} KB
                                                                </small>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="{{ $media->getUrl() }}"
                                                                   target="_blank"
                                                                   class="btn btn-sm btn-outline-primary"
                                                                   title="Lihat">
                                                                    <i class="bi bi-eye"></i>
                                                                </a>
                                                                <button type="button"
                                                                        class="btn btn-sm btn-outline-danger delete-dokumen"
                                                                        data-id="{{ $media->id }}"
                                                                        title="Hapus">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        @if($media->getCustomProperty('deskripsi'))
                                                            <div class="mt-2">
                                                                <small class="text-muted">
                                                                    {{ $media->getCustomProperty('deskripsi') }}
                                                                </small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="text-muted d-block mt-2">
                                        Total {{ $peminjaman->media->count() }} dokumen terupload.
                                    </small>
                                </div>
                            @endif

                            <!-- ======================== -->
                            <!-- UPLOAD DOKUMEN PENDUKUNG TAMBAHAN -->
                            <!-- ======================== -->
                            <div class="mb-4">
                                <label for="dokumen_files" class="form-label">
                                    Tambah Dokumen Pendukung <span class="text-muted">(Multiple Upload)</span>
                                </label>
                                <input type="file"
                                       class="form-control @error('dokumen_files.*') is-invalid @enderror"
                                       id="dokumen_files"
                                       name="dokumen_files[]"
                                       multiple
                                       accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">

                                @error('dokumen_files')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @error('dokumen_files.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <div class="form-text">
                                    Upload dokumen pendukung tambahan seperti surat permohonan, KTP, atau bukti lainnya.
                                    Format yang didukung: JPG, PNG, PDF, DOC, DOCX, XLS, XLSX.
                                    Maksimal ukuran per file: 5MB.
                                </div>

                                <!-- Input untuk deskripsi per file (optional) -->
                                <div id="dokumen-deskripsi-container" class="mt-3 d-none">
                                    <p class="text-muted small mb-2">Keterangan Dokumen:</p>
                                    <!-- Input deskripsi akan ditambahkan secara dinamis -->
                                </div>

                                <!-- Preview Area untuk gambar -->
                                <div id="dokumen-preview-container" class="mt-3 row g-2 d-none">
                                    <p class="text-muted small mb-2">Preview Dokumen:</p>
                                    <!-- Preview akan ditampilkan di sini -->
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>
                                <div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-save me-2"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('peminjaman.show', $peminjaman->pinjam_id) }}"
                                        class="btn btn-info">
                                        <i class="bi bi-eye me-2"></i> Lihat Detail
                                    </a>
                                </div>
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

        // Preview dokumen sebelum upload
        document.getElementById('dokumen_files').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('dokumen-preview-container');
            const deskripsiContainer = document.getElementById('dokumen-deskripsi-container');
            previewContainer.innerHTML = '';
            deskripsiContainer.innerHTML = '';
            previewContainer.classList.add('d-none');
            deskripsiContainer.classList.add('d-none');

            const files = e.target.files;

            if (files.length > 0) {
                previewContainer.classList.remove('d-none');
                previewContainer.innerHTML = '<p class="text-muted small mb-2">Preview (' + files.length + ' dokumen):</p>';

                deskripsiContainer.classList.remove('d-none');
                deskripsiContainer.innerHTML = '<p class="text-muted small mb-2">Keterangan Dokumen (opsional):</p>';

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    // Input deskripsi untuk setiap file
                    const deskripsiDiv = document.createElement('div');
                    deskripsiDiv.className = 'mb-2';

                    const deskripsiLabel = document.createElement('label');
                    deskripsiLabel.className = 'form-label small';
                    deskripsiLabel.htmlFor = 'dokumen_deskripsi_' + i;
                    deskripsiLabel.textContent = 'Dokumen ' + (i + 1) + ' (' + file.name + ')';

                    const deskripsiInput = document.createElement('input');
                    deskripsiInput.type = 'text';
                    deskripsiInput.className = 'form-control form-control-sm';
                    deskripsiInput.id = 'dokumen_deskripsi_' + i;
                    deskripsiInput.name = 'dokumen_deskripsi[]';
                    deskripsiInput.placeholder = 'Contoh: Surat Permohonan, KTP, dll';
                    deskripsiInput.maxLength = 255;

                    deskripsiDiv.appendChild(deskripsiLabel);
                    deskripsiDiv.appendChild(deskripsiInput);
                    deskripsiContainer.appendChild(deskripsiDiv);

                    // Preview untuk file gambar
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const col = document.createElement('div');
                            col.className = 'col-4 col-md-3 mb-3';

                            const previewDiv = document.createElement('div');
                            previewDiv.className = 'position-relative';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail w-100 h-100 object-fit-cover';
                            img.style.height = '100px';
                            img.alt = 'Preview ' + (i + 1);

                            const badge = document.createElement('span');
                            badge.className = 'position-absolute top-0 end-0 badge bg-dark';
                            badge.style.transform = 'translate(25%, -25%)';
                            badge.textContent = (i + 1);

                            previewDiv.appendChild(img);
                            previewDiv.appendChild(badge);
                            col.appendChild(previewDiv);
                            previewContainer.appendChild(col);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // Untuk non-gambar, tampilkan icon
                        const col = document.createElement('div');
                        col.className = 'col-4 col-md-3 mb-3';

                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'position-relative border rounded p-2 text-center';

                        const icon = document.createElement('i');
                        icon.className = 'bi bi-file-earmark-text fs-1 text-muted';

                        const fileName = document.createElement('div');
                        fileName.className = 'small text-truncate mt-1';
                            fileName.textContent = file.name;

                        const badge = document.createElement('span');
                        badge.className = 'position-absolute top-0 end-0 badge bg-secondary';
                        badge.style.transform = 'translate(25%, -25%)';
                        badge.textContent = (i + 1);

                        previewDiv.appendChild(icon);
                        previewDiv.appendChild(fileName);
                        previewDiv.appendChild(badge);
                        col.appendChild(previewDiv);
                        previewContainer.appendChild(col);
                    }
                }
            }
        });

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Hitung durasi awal
            hitungDurasi();

            // Format biaya dengan titik setiap 3 digit
            const totalBiaya = document.getElementById('total_biaya');

            // Format biaya saat halaman dimuat
            if (totalBiaya.value) {
                const value = parseInt(totalBiaya.value);
                totalBiaya.value = value.toLocaleString('id-ID');
            }

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
                const tanggalMulai = document.getElementById('tanggal_mulai');
                const tanggalSelesai = document.getElementById('tanggal_selesai');

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

            // Tambahkan event listener untuk validasi real-time
            document.getElementById('tanggal_mulai').addEventListener('change', function() {
                // Update tanggal selesai min
                const tanggalSelesai = document.getElementById('tanggal_selesai');
                tanggalSelesai.min = this.value;

                // Jika tanggal selesai lebih kecil dari tanggal mulai, update
                if (tanggalSelesai.value && new Date(tanggalSelesai.value) < new Date(this.value)) {
                    tanggalSelesai.value = this.value;
                }

                hitungDurasi();
            });

            document.getElementById('tanggal_selesai').addEventListener('change', hitungDurasi);

            // Handler untuk menghapus dokumen yang sudah diupload
            document.querySelectorAll('.delete-dokumen').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const mediaId = this.getAttribute('data-id');

                    if (confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) {
                        fetch(`/peminjaman/{{ $peminjaman->pinjam_id }}/media/${mediaId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Hapus elemen dari DOM
                                this.closest('.col-md-6').remove();
                                alert('Dokumen berhasil dihapus');
                            } else {
                                alert('Gagal menghapus dokumen');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus dokumen');
                        });
                    }
                });
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

        .btn {
            min-width: 120px;
        }

        #dokumen-preview-container img {
            object-fit: cover;
            border: 1px solid #dee2e6;
        }

        #dokumen-preview-container .bi-file-earmark-text {
            font-size: 3rem;
        }

        .delete-dokumen:hover {
            color: #fff !important;
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }
    </style>
@endsection
