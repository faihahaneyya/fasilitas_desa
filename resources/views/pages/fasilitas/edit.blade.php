@extends('layouts.guest.app')

@section('title', 'Edit Fasilitas')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="bi bi-pencil text-success me-2"></i> Edit Fasilitas Umum
                        </h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('fasilitas.update', $fasilita->fasilitas_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nama Fasilitas -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Fasilitas <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $fasilita->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jenis Fasilitas -->
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis') is-invalid @enderror" id="jenis"
                                    name="jenis" required>
                                    @foreach ($jenisOptions as $jenis)
                                        <option value="{{ $jenis }}"
                                            {{ old('jenis', $fasilita->jenis) == $jenis ? 'selected' : '' }}>
                                            {{ $jenis }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                    required>{{ old('alamat', $fasilita->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- RT -->
                                <div class="col-md-6 mb-3">
                                    <label for="rt" class="form-label">RT</label>
                                    <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                        id="rt" name="rt" value="{{ old('rt', $fasilita->rt) }}" maxlength="3">
                                    @error('rt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- RW -->
                                <div class="col-md-6 mb-3">
                                    <label for="rw" class="form-label">RW</label>
                                    <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                        id="rw" name="rw" value="{{ old('rw', $fasilita->rw) }}"
                                        maxlength="3">
                                    @error('rw')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kapasitas -->
                            <div class="mb-3">
                                <label for="kapasitas" class="form-label">Kapasitas (orang)</label>
                                <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                                    id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $fasilita->kapasitas) }}"
                                    min="0">
                                @error('kapasitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $fasilita->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ======================== -->
                            <!-- FOTO YANG SUDAH DIUPLOAD -->
                            <!-- ======================== -->
                            @if($fasilita->media->count() > 0)
                            <div class="mb-4">
                                <label class="form-label">Foto Fasilitas (Sudah Upload)</label>
                                <div class="row g-3" id="existing-photos">
                                    @foreach($fasilita->media as $index => $media)
                                    <div class="col-4 col-md-3">
                                        <div class="position-relative border rounded p-2">
                                            <img src="{{ $media->file_url }}"
                                                 alt="{{ $media->caption }}"
                                                 class="img-fluid rounded w-100"
                                                 style="height: 100px; object-fit: cover;">
                                            @if($media->caption)
                                            <small class="text-muted d-block mt-1">{{ Str::limit($media->caption, 20) }}</small>
                                            @endif
                                            <div class="position-absolute top-0 end-0">
                                                <button type="button"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="deleteMedia({{ $media->media_id }})"
                                                        title="Hapus foto">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- ======================== -->
                            <!-- UPLOAD FOTO TAMBAHAN -->
                            <!-- ======================== -->
                            <div class="mb-4">
                                <label for="media_files" class="form-label">
                                    Tambah Foto Fasilitas <span class="text-muted">(Multiple Upload)</span>
                                </label>
                                <input type="file"
                                       class="form-control @error('media_files.*') is-invalid @enderror"
                                       id="media_files"
                                       name="media_files[]"
                                       multiple
                                       accept="image/*">

                                @error('media_files')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @error('media_files.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <div class="form-text">
                                    Bisa upload lebih dari satu foto. Format yang didukung: JPG, PNG, GIF, JPEG.
                                    Maksimal ukuran per file: 2MB.
                                </div>

                                <!-- Input untuk caption per file (optional) -->
                                <div id="caption-container" class="mt-3 d-none">
                                    <p class="text-muted small mb-2">Keterangan Foto Tambahan:</p>
                                    <!-- Input caption akan ditambahkan secara dinamis -->
                                </div>

                                <!-- Preview Area -->
                                <div id="preview-container" class="mt-3 row g-2 d-none">
                                    <p class="text-muted small mb-2">Preview Foto Baru:</p>
                                    <!-- Preview images will be inserted here -->
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save me-2"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Preview multiple images before upload dan tambahkan input caption
    document.getElementById('media_files').addEventListener('change', function(e) {
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
            captionContainer.innerHTML = '<p class="text-muted small mb-2">Keterangan Foto (opsional):</p>';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Preview image
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

                    // Input caption untuk setiap file
                    const captionDiv = document.createElement('div');
                    captionDiv.className = 'mb-2';

                    const captionLabel = document.createElement('label');
                    captionLabel.className = 'form-label small';
                    captionLabel.htmlFor = 'caption_' + i;
                    captionLabel.textContent = 'Keterangan Foto ' + (i + 1) + ' (' + file.name + ')';

                    const captionInput = document.createElement('input');
                    captionInput.type = 'text';
                    captionInput.className = 'form-control form-control-sm';
                    captionInput.id = 'caption_' + i;
                    captionInput.name = 'captions[]';
                    captionInput.placeholder = 'Masukkan keterangan foto (opsional)';
                    captionInput.maxLength = 255;

                    captionDiv.appendChild(captionLabel);
                    captionDiv.appendChild(captionInput);
                    captionContainer.appendChild(captionDiv);
                };

                reader.readAsDataURL(file);
            }
        }
    });

    // Fungsi untuk menghapus media
    function deleteMedia(mediaId) {
        if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
            fetch(`/fasilitas/media/${mediaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hapus elemen dari DOM
                    document.querySelector(`[onclick="deleteMedia(${mediaId})"]`).closest('.col-4').remove();
                    alert('Foto berhasil dihapus');

                    // Jika tidak ada foto lagi, sembunyikan section
                    if (document.querySelectorAll('#existing-photos .col-4').length === 0) {
                        document.querySelector('#existing-photos').closest('.mb-4').remove();
                    }
                } else {
                    alert('Gagal menghapus foto');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus foto');
            });
        }
    }
</script>
@endpush
