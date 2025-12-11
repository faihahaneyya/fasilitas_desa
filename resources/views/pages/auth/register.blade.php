@extends('layouts.guest.app')

@section('title', 'Register')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5 mt-100 mb-100">
            <div class="col-md-8 col-lg-7">
                <div class="card border-0 shadow">
                    <div class="row g-0">
                        <!-- Form Register -->
                        <div class="col-md-6">
                            <div class="card-body p-4 p-md-5">
                                <div class="text-center mb-4">
                                    <h3 class="fw-bold text-success">
                                        <i class="bi bi-person-plus-fill"></i> Daftar Akun
                                    </h3>
                                    <p class="text-muted">Buat akun baru Anda</p>
                                </div>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name Field -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required autofocus
                                            placeholder="Masukkan nama lengkap">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email Field -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required
                                            placeholder="contoh@email.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password Field -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                name="password" required placeholder="Minimal 8 karakter">
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="togglePassword('password')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            Password minimal 8 karakter.
                                        </div>
                                    </div>

                                    <!-- Password Confirmation Field -->
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" required placeholder="Ketik ulang password">
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="togglePassword('password_confirmation')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="d-grid mb-3">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="bi bi-person-plus me-2"></i> Daftar Sekarang
                                        </button>
                                    </div>

                                    <!-- Link to Login -->
                                    <div class="text-center">
                                        <p class="text-muted mb-0">
                                            Sudah punya akun?
                                            <a href="{{ route('login') }}"
                                                class="text-success text-decoration-none fw-semibold">
                                                Login di sini
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Info Panel -->
                        <div class="col-md-6 bg-success text-white">
                            <div class="card-body p-4 p-md-5 d-flex flex-column justify-content-center h-100">
                                <h2 class="fw-bold mb-4">Selamat Datang!</h2>
                                <p class="mb-4">
                                    Bergabunglah dengan kami untuk mendapatkan akses ke semua fitur:
                                </p>

                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <i class="bi bi-check-circle-fill me-2"></i> Sistem manajemen modern
                                    </li>
                                    <li class="mb-3">
                                        <i class="bi bi-check-circle-fill me-2"></i> Keamanan data terjamin
                                    </li>
                                    <li class="mb-3">
                                        <i class="bi bi-check-circle-fill me-2"></i> Antarmuka user-friendly
                                    </li>
                                    <li class="mb-3">
                                        <i class="bi bi-check-circle-fill me-2"></i> Dukungan teknis 24/7
                                    </li>
                                    <li class="mb-3">
                                        <i class="bi bi-check-circle-fill me-2"></i> Update fitur berkala
                                    </li>
                                </ul>

                                <div class="mt-4">
                                    <div class="alert alert-light" role="alert">
                                        <i class="bi bi-info-circle me-2 text-success"></i>
                                        <strong>Penting!</strong> Pastikan email yang Anda gunakan valid.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function togglePassword(fieldId) {
                const field = document.getElementById(fieldId);
                const icon = field.nextElementSibling.querySelector('i');

                if (field.type === 'password') {
                    field.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    field.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }
        </script>
    @endpush
@endsection
