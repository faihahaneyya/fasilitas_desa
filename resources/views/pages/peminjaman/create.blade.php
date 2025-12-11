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
                        <form action="{{ route('peminjaman.store') }}" method="POST" id="peminjamanForm">
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
                            <div class="mb-4">
                                <label for="catatan" class="form-label">Catatan (opsional)</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
    </style>
@endsection
