@extends('layouts.guest.app')

@section('title', 'Edit Peminjaman')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-smmb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">
                                <i class="bi bi-pencil text-success me-2"></i> Edit Data Peminjaman
                            </h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('peminjaman.update', $peminjaman->pinjam_id) }}" method="POST"
                                id="peminjamanForm" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="status" class="form-label fw-bold">Status Peminjaman <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        @foreach ($statusOptions as $key => $label)
                                            <option value="{{ $key }}" {{ old('status', $peminjaman->status) == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="fasilitas_id" class="form-label fw-bold">Pilih Fasilitas <span class="text-danger">*</span></label>
                                    <select class="form-select @error('fasilitas_id') is-invalid @enderror" id="fasilitas_id" name="fasilitas_id" required>
                                        <option value="">Pilih Fasilitas</option>
                                        @foreach ($fasilitas as $fas)
                                            <option value="{{ $fas->fasilitas_id }}" {{ old('fasilitas_id', $peminjaman->fasilitas_id) == $fas->fasilitas_id ? 'selected' : '' }}>
                                                {{ $fas->name }} ({{ $fas->jenis }}) - {{ $fas->lokasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fasilitas_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="warga_id" class="form-label fw-bold">Pilih Peminjam <span class="text-danger">*</span></label>
                                    <select class="form-select @error('warga_id') is-invalid @enderror" id="warga_id" name="warga_id" required>
                                        <option value="">Pilih Warga</option>
                                        @foreach ($warga as $w)
                                            <option value="{{ $w->warga_id }}" {{ old('warga_id', $peminjaman->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} (NIK: {{ $w->no_ktp }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('warga_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_mulai" class="form-label fw-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                            id="tanggal_mulai" name="tanggal_mulai"
                                            value="{{ old('tanggal_mulai', $peminjaman->tanggal_mulai->format('Y-m-d')) }}"
                                            required onchange="hitungDurasi()">
                                        @error('tanggal_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_selesai" class="form-label fw-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                            id="tanggal_selesai" name="tanggal_selesai"
                                            value="{{ old('tanggal_selesai', $peminjaman->tanggal_selesai->format('Y-m-d')) }}"
                                            required onchange="hitungDurasi()">
                                        @error('tanggal_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Durasi Peminjaman</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-info text-white border-info">
                                            <i class="bi bi-calendar-range"></i>
                                        </span>
                                        <input type="text" class="form-control bg-light" id="durasiDisplay" value="0 hari" readonly>
                                        <span class="input-group-text">Hari</span>
                                    </div>
                                    <small class="text-muted">Dihitung otomatis dari tanggal mulai dan selesai</small>
                                </div>

                                <div class="mb-3">
                                    <label for="tujuan" class="form-label fw-bold">Tujuan Peminjaman <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('tujuan') is-invalid @enderror" id="tujuan" name="tujuan" rows="3" required>{{ old('tujuan', $peminjaman->tujuan) }}</textarea>
                                    @error('tujuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="total_biaya" class="form-label fw-bold">Total Biaya (Rp) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('total_biaya') is-invalid @enderror"
                                        id="total_biaya_display" 
                                        value="{{ number_format(old('total_biaya', $peminjaman->total_biaya), 0, ',', '.') }}" required>
                                    <input type="hidden" name="total_biaya" id="total_biaya" value="{{ old('total_biaya', $peminjaman->total_biaya) }}">
                                    @error('total_biaya')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="catatan" class="form-label fw-bold">Catatan (opsional)</label>
                                    <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="2">{{ old('catatan', $peminjaman->catatan) }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr class="my-4">

                                @if($peminjaman->media && $peminjaman->media->count() > 0)
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Dokumen Terupload</label>
                                        <div class="row g-2">
                                            @foreach($peminjaman->media as $media)
                                                <div class="col-md-6" id="media-card-{{ $media->id }}">
                                                    <div class="card border shadow-sm h-100">
                                                        <div class="card-body p-2 d-flex align-items-center">
                                                            @if(Str::startsWith($media->mime_type, 'image/'))
                                                                <img src="{{ asset('storage/' . $media->file_name) }}" class="img-thumbnail me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                                            @else
                                                                <div class="bg-light rounded p-2 me-2 text-center" style="width: 50px;">
                                                                    <i class="bi bi-file-earmark-pdf text-danger fs-4"></i>
                                                                </div>
                                                            @endif
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <small class="d-block text-truncate fw-bold">{{ $media->caption ?? 'Tanpa Keterangan' }}</small>
                                                                <small class="text-muted" style="font-size: 10px;">{{ basename($media->file_name) }}</small>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="{{ asset('storage/' . $media->file_name) }}" target="_blank" class="btn btn-sm btn-outline-primary px-2"><i class="bi bi-eye"></i></a>
                                                                <button type="button" 
                                                                    class="btn btn-sm btn-outline-danger px-2 btn-hapus-media" 
                                                                    data-id="{{ $media->id }}"
                                                                    title="Hapus Dokumen">
                                                                    <i class="bi bi-trash" id="icon-{{ $media->id }}"></i>
                                                                    <span class="spinner-border spinner-border-sm d-none" id="spinner-{{ $media->id }}" role="status"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-4 bg-light p-3 rounded border">
                                    <label for="dokumen_files" class="form-label fw-bold">Tambah Dokumen Baru</label>
                                    <input type="file" class="form-control @error('dokumen_files.*') is-invalid @enderror"
                                           id="dokumen_files" name="dokumen_files[]" multiple
                                           accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">

                                    <div id="dokumen-deskripsi-container" class="mt-3 d-none">
                                        <p class="text-muted small mb-2 fw-bold">Keterangan Dokumen Baru:</p>
                                        <div id="description-inputs-area"></div>
                                    </div>

                                    <div id="dokumen-preview-container" class="mt-3 row g-2 d-none">
                                        </div>

                                    <div class="form-text mt-2">
                                        Format: JPG, PNG, PDF, DOCX. Maks: 5MB per file.
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5">
                                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary px-4">
                                        <i class="bi bi-arrow-left me-2"></i> Kembali
                                    </a>
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-success px-4">
                                            <i class="bi bi-save me-2"></i> Simpan Perubahan
                                        </button>
                                        <a href="{{ route('peminjaman.show', $peminjaman->pinjam_id) }}" class="btn btn-info px-4 text-white">
                                            <i class="bi bi-eye me-2"></i> Detail
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
            // 1. Hitung Durasi Otomatis
            function hitungDurasi() {
                const startInput = document.getElementById('tanggal_mulai');
                const endInput = document.getElementById('tanggal_selesai');
                const display = document.getElementById('durasiDisplay');

                if (startInput.value && endInput.value) {
                    const start = new Date(startInput.value);
                    const end = new Date(endInput.value);

                    if (end < start) {
                        display.value = 'Error';
                        display.classList.add('text-danger');
                        endInput.classList.add('is-invalid');
                    } else {
                        const diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                        display.value = diff + ' hari';
                        display.classList.remove('text-danger');
                        endInput.classList.remove('is-invalid');
                    }
                }
            }

            // 2. Format Mata Uang (Rupiah)
            const displayBiaya = document.getElementById('total_biaya_display');
            const hiddenBiaya = document.getElementById('total_biaya');

            displayBiaya.addEventListener('keyup', function(e) {
                let value = this.value.replace(/\D/g, '');
                hiddenBiaya.value = value;
                this.value = new Intl.NumberFormat('id-ID').format(value);
            });

            // 3. Preview & Dynamic Inputs untuk Dokumen Baru
            document.getElementById('dokumen_files').addEventListener('change', function(e) {
                const previewContainer = document.getElementById('dokumen-preview-container');
                const descContainer = document.getElementById('dokumen-deskripsi-container');
                const inputsArea = document.getElementById('description-inputs-area');

                previewContainer.innerHTML = '';
                inputsArea.innerHTML = '';

                const files = e.target.files;

                if (files.length > 0) {
                    previewContainer.classList.remove('d-none');
                    descContainer.classList.remove('d-none');

                    Array.from(files).forEach((file, i) => {
                        // Buat Input Deskripsi
                        const div = document.createElement('div');
                        div.className = 'input-group mb-2';
                        div.innerHTML = `
                            <span class="input-group-text small">File ${i+1}</span>
                            <input type="text" name="captions[]" class="form-control form-control-sm" placeholder="Keterangan untuk ${file.name}">
                        `;
                        inputsArea.appendChild(div);

                        // Buat Preview Gambar
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(event) {
                                const col = document.createElement('div');
                                col.className = 'col-3';
                                col.innerHTML = `
                                    <div class="position-relative">
                                        <img src="${event.target.result}" class="img-thumbnail w-100" style="height:80px; object-fit:cover;">
                                        <span class="position-absolute top-0 start-0 badge bg-dark">${i+1}</span>
                                    </div>
                                `;
                                previewContainer.appendChild(col);
                            }
                            reader.readAsDataURL(file);
                        } else {
                            const col = document.createElement('div');
                            col.className = 'col-3';
                            col.innerHTML = `
                                <div class="bg-white border rounded p-2 text-center" style="height:80px">
                                    <i class="bi bi-file-earmark-text text-secondary fs-2"></i>
                                    <div class="small text-truncate">${file.name}</div>
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

            // 4. AJAX Delete Media
            document.querySelectorAll('.delete-dokumen').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    if (confirm('Hapus dokumen ini secara permanen?')) {
                        fetch(`/media/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById(`media-card-${id}`).remove();
                            }
                        })
                        .catch(err => alert('Gagal menghapus file.'));
                    }
                });
            });

            // Pastikan menyertakan CSRF Token untuk request DELETE
            $(document).ready(function() {
                $('.btn-hapus-media').on('click', function() {
                    const mediaId = $(this).data('id');
                    const card = $(`#media-card-${mediaId}`);
                    const icon = $(`#icon-${mediaId}`);
                    const spinner = $(`#spinner-${mediaId}`);
                    const btn = $(this);

                    if (confirm('Hapus file ini secara permanen?')) {
                        // Tampilkan loading
                        icon.addClass('d-none');
                        spinner.removeClass('d-none');
                        btn.prop('disabled', true);

                        $.ajax({
                            url: `/peminjaman/media/${mediaId}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Animasi hapus kartu
                                    card.addClass('animate__animated animate__fadeOutDown'); // jika pakai animate.css
                                    card.fadeOut(400, function() {
                                        $(this).remove();
                                    });
                                }
                            },
                            error: function(xhr) {
                                alert('Gagal menghapus file: ' + xhr.responseText);
                                // Kembalikan tombol jika gagal
                                icon.removeClass('d-none');
                                spinner.addClass('d-none');
                                btn.prop('disabled', false);
                            }
                        });
                    }
                });
            });
            // Inisialisasi awal
            document.addEventListener('DOMContentLoaded', hitungDurasi);
        </script>

        <style>
            .form-label { font-size: 0.9rem; }
            .img-thumbnail { border-radius: 8px; }
            .input-group-text { font-size: 0.85rem; }
            .btn { border-radius: 6px; font-weight: 500; }
            .card { border-radius: 12px; }
        </style>
@endsection