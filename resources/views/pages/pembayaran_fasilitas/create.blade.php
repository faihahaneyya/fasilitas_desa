@extends('layouts.guest.app')

@section('title', 'Tambah Pembayaran Baru')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-plus-circle text-primary me-2"></i> Tambah Pembayaran Baru
                </h4>
                <p class="text-muted mb-0">Isi form di bawah untuk menambahkan pembayaran baru</p>
            </div>
            <a href="{{ route('pembayaran-fasilitas.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <!-- Form Container -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('pembayaran-fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <!-- Peminjaman -->
                                    <div class="mb-3">
                                        <label for="pinjam_id" class="form-label fw-semibold">
                                            <i class="bi bi-link-45deg text-muted me-2"></i>ID Peminjaman
                                        </label>
                                        <select name="pinjam_id" id="pinjam_id"
                                            class="form-select @error('pinjam_id') is-invalid @enderror" required>
                                            <option value="">Pilih Peminjaman</option>
                                            @foreach ($peminjaman as $p)
                                                <option value="{{ $p->pinjam_id }}"
                                                    {{ old('pinjam_id') == $p->pinjam_id ? 'selected' : '' }}>
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
                                            value="{{ old('tanggal', date('Y-m-d')) }}"
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
                                            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}"
                                                step="0.01" min="0"
                                                class="form-control @error('jumlah') is-invalid @enderror"
                                                placeholder="0.00" required>
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
                                            <option value="">Pilih Metode</option>
                                            <option value="tunai" {{ old('metode') == 'tunai' ? 'selected' : '' }}>Tunai
                                            </option>
                                            <option value="transfer" {{ old('metode') == 'transfer' ? 'selected' : '' }}>
                                                Transfer Bank</option>
                                            <option value="kartu_kredit"
                                                {{ old('metode') == 'kartu_kredit' ? 'selected' : '' }}>Kartu Kredit
                                            </option>
                                            <option value="debit" {{ old('metode') == 'debit' ? 'selected' : '' }}>Kartu
                                                Debit</option>
                                            <option value="qris" {{ old('metode') == 'qris' ? 'selected' : '' }}>QRIS
                                            </option>
                                            <option value="lainnya" {{ old('metode') == 'lainnya' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                        @error('metode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- ======================== -->
                            <!-- UPLOAD BUKTI PEMBAYARAN -->
                            <!-- ======================== -->
                            <div class="mb-4">
                                <label for="bukti_files" class="form-label fw-semibold">
                                    <i class="bi bi-paperclip text-muted me-2"></i>Bukti Pembayaran
                                    <span class="text-muted">(Multiple Upload)</span>
                                </label>
                                <input type="file"
                                       class="form-control @error('bukti_files.*') is-invalid @enderror"
                                       id="bukti_files"
                                       name="bukti_files[]"
                                       multiple
                                       accept="image/*,.pdf,.doc,.docx">

                                @error('bukti_files')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @error('bukti_files.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <div class="form-text">
                                    Bisa upload lebih dari satu file bukti. Format yang didukung:
                                    Gambar (JPG, PNG, GIF), PDF, Word. Maksimal ukuran per file: 2MB.
                                    File akan disimpan di tabel <strong>media</strong>.
                                </div>

                                <!-- Input untuk caption per file (optional) -->
                                <div id="caption-container" class="mt-3 d-none">
                                    <p class="text-muted small mb-2">Keterangan File Bukti:</p>
                                    <!-- Input caption akan ditambahkan secara dinamis -->
                                </div>

                                <!-- Preview Area -->
                                <div id="preview-container" class="mt-3 row g-2 d-none">
                                    <p class="text-muted small mb-2">Preview:</p>
                                    <!-- Preview images will be inserted here -->
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-4">
                                <label for="keterangan" class="form-label fw-semibold">
                                    <i class="bi bi-card-text text-muted me-2"></i>Keterangan (Opsional)
                                </label>
                                <textarea name="keterangan" id="keterangan" rows="4"
                                    class="form-control @error('keterangan') is-invalid @enderror"
                                    placeholder="Catatan tambahan tentang pembayaran ini">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between border-top pt-4 mt-3">
                                <a href="{{ route('pembayaran-fasilitas.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i> Simpan Pembayaran
                                </button>
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
    </style>
@endsection

@push('scripts')
<script>
    // Preview multiple images before upload dan tambahkan input caption
    document.getElementById('bukti_files').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('preview-container');
        const captionContainer = document.getElementById('caption-container');
        previewContainer.innerHTML = '';
        captionContainer.innerHTML = '';
        previewContainer.classList.add('d-none');
        captionContainer.classList.add('d-none');

        const files = e.target.files;

        if (files.length > 0) {
            previewContainer.classList.remove('d-none');
            previewContainer.innerHTML = '<p class="text-muted small mb-2">Preview (' + files.length + ' file):</p>';

            // Tampilkan caption container jika ada file
            captionContainer.classList.remove('d-none');
            captionContainer.innerHTML = '<p class="text-muted small mb-2">Keterangan File (opsional):</p>';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Preview image
                    const col = document.createElement('div');
                    col.className = 'col-4 col-md-3 mb-3';

                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'position-relative';

                    // Cek tipe file
                    if (file.type.startsWith('image/')) {
                        // Preview untuk gambar
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail w-100 h-100 object-fit-cover';
                        img.style.height = '100px';
                        img.alt = 'Preview ' + (i + 1);
                        previewDiv.appendChild(img);
                    } else {
                        // Preview untuk non-gambar (PDF, Word, dll)
                        const iconDiv = document.createElement('div');
                        iconDiv.className = 'bg-light d-flex flex-column align-items-center justify-content-center rounded border';
                        iconDiv.style.height = '100px';

                        const icon = document.createElement('i');
                        if (file.type === 'application/pdf') {
                            icon.className = 'bi bi-file-earmark-pdf text-danger fs-3';
                        } else if (file.type.includes('word') || file.type.includes('document')) {
                            icon.className = 'bi bi-file-earmark-word text-primary fs-3';
                        } else {
                            icon.className = 'bi bi-file-earmark fs-3';
                        }

                        const fileName = document.createElement('small');
                        fileName.className = 'text-muted text-center mt-2';
                        fileName.textContent = file.name.length > 15 ? file.name.substring(0, 15) + '...' : file.name;

                        iconDiv.appendChild(icon);
                        iconDiv.appendChild(fileName);
                        previewDiv.appendChild(iconDiv);
                    }

                    const badge = document.createElement('span');
                    badge.className = 'position-absolute top-0 end-0 badge bg-dark';
                    badge.style.transform = 'translate(25%, -25%)';
                    badge.textContent = (i + 1);

                    previewDiv.appendChild(badge);
                    col.appendChild(previewDiv);
                    previewContainer.appendChild(col);

                    // Input caption untuk setiap file
                    const captionDiv = document.createElement('div');
                    captionDiv.className = 'mb-2';

                    const captionLabel = document.createElement('label');
                    captionLabel.className = 'form-label small';
                    captionLabel.htmlFor = 'caption_' + i;
                    captionLabel.textContent = 'Keterangan ' + (i + 1) + ' (' + file.name + ')';

                    const captionInput = document.createElement('input');
                    captionInput.type = 'text';
                    captionInput.className = 'form-control form-control-sm';
                    captionInput.id = 'caption_' + i;
                    captionInput.name = 'captions[]';
                    captionInput.placeholder = 'Masukkan keterangan file (opsional)';
                    captionInput.maxLength = 255;

                    captionDiv.appendChild(captionLabel);
                    captionDiv.appendChild(captionInput);
                    captionContainer.appendChild(captionDiv);
                };

                if (file.type.startsWith('image/')) {
                    reader.readAsDataURL(file);
                } else {
                    // Untuk non-image files, langsung tambahkan preview tanpa data URL
                    const col = document.createElement('div');
                    col.className = 'col-4 col-md-3 mb-3';

                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'position-relative';

                    const iconDiv = document.createElement('div');
                    iconDiv.className = 'bg-light d-flex flex-column align-items-center justify-content-center rounded border';
                    iconDiv.style.height = '100px';

                    const icon = document.createElement('i');
                    if (file.type === 'application/pdf') {
                        icon.className = 'bi bi-file-earmark-pdf text-danger fs-3';
                    } else if (file.type.includes('word') || file.type.includes('document')) {
                        icon.className = 'bi bi-file-earmark-word text-primary fs-3';
                    } else {
                        icon.className = 'bi bi-file-earmark fs-3';
                    }

                    const fileName = document.createElement('small');
                    fileName.className = 'text-muted text-center mt-2';
                    fileName.textContent = file.name.length > 15 ? file.name.substring(0, 15) + '...' : file.name;

                    iconDiv.appendChild(icon);
                    iconDiv.appendChild(fileName);

                    const badge = document.createElement('span');
                    badge.className = 'position-absolute top-0 end-0 badge bg-dark';
                    badge.style.transform = 'translate(25%, -25%)';
                    badge.textContent = (i + 1);

                    previewDiv.appendChild(iconDiv);
                    previewDiv.appendChild(badge);
                    col.appendChild(previewDiv);
                    previewContainer.appendChild(col);

                    // Input caption untuk setiap file
                    const captionDiv = document.createElement('div');
                    captionDiv.className = 'mb-2';

                    const captionLabel = document.createElement('label');
                    captionLabel.className = 'form-label small';
                    captionLabel.htmlFor = 'caption_' + i;
                    captionLabel.textContent = 'Keterangan ' + (i + 1) + ' (' + file.name + ')';

                    const captionInput = document.createElement('input');
                    captionInput.type = 'text';
                    captionInput.className = 'form-control form-control-sm';
                    captionInput.id = 'caption_' + i;
                    captionInput.name = 'captions[]';
                    captionInput.placeholder = 'Masukkan keterangan file (opsional)';
                    captionInput.maxLength = 255;

                    captionDiv.appendChild(captionLabel);
                    captionDiv.appendChild(captionInput);
                    captionContainer.appendChild(captionDiv);
                }
            }
        }
    });
</script>
@endpush
