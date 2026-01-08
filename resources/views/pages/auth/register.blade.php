@extends('layouts.guest.app')

@section('title', 'Register')

@section('content')
    <style>
        /* Background styling */
        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.2) 0%, rgba(25, 135, 84, 0.3) 100%);
            z-index: 1;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1448375240586-882707db888b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.4;
            z-index: 0;
            filter: brightness(1.05) contrast(1.1);
        }

        /* Leaf decoration */
        .leaf-decoration {
            position: absolute;
            opacity: 0.1;
            z-index: -1;
        }

        .leaf-1 {
            top: 10%;
            right: 10%;
            width: 100px;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23198754'%3E%3Cpath d='M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5c0 1.5 1.5 3 5.5 3 2.5 0 8.5-1 8.5-1v-2.25s-4 1-6.5 1c-2 0-4-1-4-2.5C5.5 10 8 7 17 8z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: contain;
        }

        .leaf-2 {
            bottom: 15%;
            left: 8%;
            width: 80px;
            height: 80px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23158746'%3E%3Cpath d='M12 2C8.1 2 5 5.1 5 9c0 5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5s1.1-2.5 2.5-2.5 2.5 1.1 2.5 2.5-1.1 2.5-2.5 2.5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: contain;
        }

        /* Card styling */
        .card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(40, 167, 69, 0.3);
            box-shadow: 0 10px 40px rgba(25, 135, 84, 0.15);
            border-radius: 15px;
            overflow: hidden;
        }

        /* Info panel styling */
        .bg-success {
            background: linear-gradient(135deg, #198754, #20c997) !important;
        }

        /* Form styling */
        .form-label {
            color: #495057;
            font-weight: 500;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }

        /* Button styling */
        .btn-success {
            background: linear-gradient(135deg, #198754, #20c997);
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #157347, #198754);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card {
                background: rgba(255, 255, 255, 0.98);
                margin: 1rem;
            }
            .background-image {
                opacity: 0.35;
            }
            .leaf-decoration {
                display: none;
            }
            .row.g-0 {
                flex-direction: column;
            }
            .col-md-6 {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .background-image {
                opacity: 0.3;
            }
            .card-body {
                padding: 1.5rem;
            }
        }
    </style>

    <!-- Background Section -->
    <div class="background-container">
        <div class="background-image"></div>
        <div class="background-overlay"></div>
        <div class="leaf-decoration leaf-1"></div>
        <div class="leaf-decoration leaf-2"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-md-8 col-lg-7">
                <div class="card border-0 shadow">
                    <div class="row g-0">
                        <!-- Form Register -->
                        <div class="col-md-6">
                            <div class="card-body p-4 p-md-5">
                                <div class="text-center mb-4">
                                    <div class="mb-3">
                                        <i class="bi bi-tree display-5 text-success"></i>
                                    </div>
                                    <h3 class="fw-bold text-success">
                                        Daftar Akun Desa
                                    </h3>
                                    <p class="text-muted">Bergabunglah dengan komunitas desa kami</p>
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
                                <h2 class="fw-bold mb-4">Selamat Datang di Desa!</h2>
                                <p class="mb-4">
                                    Daftarkan diri Anda untuk mengakses fasilitas desa dengan mudah:
                                </p>

                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <i class="bi bi-check-circle-fill me-2"></i> Ajukan peminjaman fasilitas
                                    </li>
                                    <li class="mb-3">
                                        <i class="bi bi-check-circle-fill me-2"></i> Pantau status peminjaman
                                    </li>
                                    <li class="mb-3">
                                        <i class="bi bi-check-circle-fill me-2"></i> Lihat ketersediaan fasilitas
                                    </li>
                                    <li class="mb-3">
                                        <i class="bi bi-check-circle-fill me-2"></i> Bayar secara online
                                    </li>
                                    <li class="mb-3">
                                        <i class="bi bi-check-circle-fill me-2"></i> Akses informasi desa
                                    </li>
                                </ul>

                                <div class="mt-4">
                                    <div class="alert alert-light" role="alert">
                                        <i class="bi bi-info-circle me-2 text-success"></i>
                                        <strong>Penting!</strong> Pastikan data yang Anda isi valid dan benar.
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
