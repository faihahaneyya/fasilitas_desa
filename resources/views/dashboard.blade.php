@extends('layouts.guest.app')

@section('title', 'Dashboard - Fasilitas Desa')

@section('content')
    <!-- HERO SECTION WITH SLIDESHOW -->
    <section class="hero-section" id="home">
        <div id="fasilitasCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#fasilitasCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#fasilitasCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#fasilitasCarousel" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#fasilitasCarousel" data-bs-slide-to="3"></button>
            </div>

            <!-- Slides -->
            <div class="carousel-inner">
                <!-- Slide 1: Balai Desa -->
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1598520101653-64e016b8a8e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80"
                         class="d-block w-100"
                         alt="Balai Desa"
                         style="height: 600px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-5 fw-bold">Balai Desa</h2>
                        <p class="lead">Tempat berkumpul warga untuk musyawarah dan kegiatan sosial</p>
                        <a href="{{ route('fasilitas.index') }}" class="btn btn-success btn-lg">Lihat Fasilitas</a>
                    </div>
                </div>

                <!-- Slide 2: Lapangan Olahraga -->
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1535131749006-b7f58c99034b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80"
                         class="d-block w-100"
                         alt="Lapangan Olahraga"
                         style="height: 600px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-5 fw-bold">Lapangan Olahraga</h2>
                        <p class="lead">Fasilitas olahraga untuk kesehatan dan kebugaran warga</p>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-primary btn-lg">Ajukan Peminjaman</a>
                    </div>
                </div>

                <!-- Slide 3: Perpustakaan Desa -->
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80"
                         class="d-block w-100"
                         alt="Perpustakaan Desa"
                         style="height: 600px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-5 fw-bold">Perpustakaan Desa</h2>
                        <p class="lead">Sumber ilmu pengetahuan dan literasi masyarakat</p>
                        <a href="{{ route('fasilitas.index') }}" class="btn btn-warning btn-lg">Eksplor Fasilitas</a>
                    </div>
                </div>

                <!-- Slide 4: Posyandu -->
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80"
                         class="d-block w-100"
                         alt="Posyandu"
                         style="height: 600px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-5 fw-bold">Pos Pelayanan Terpadu</h2>
                        <p class="lead">Layanan kesehatan ibu dan anak untuk masyarakat</p>
                        <a href="{{ route('about') }}" class="btn btn-info btn-lg">Tentang Kami</a>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#fasilitasCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#fasilitasCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="fw-bold text-primary">Fasilitas Desa Kita</h2>
                    <p class="lead text-muted">Kelola dan manfaatkan fasilitas desa dengan mudah melalui sistem kami</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-building display-4 text-success"></i>
                            </div>
                            <h4 class="card-title">Fasilitas Umum</h4>
                            <p class="card-text text-muted">
                                Akses informasi lengkap tentang berbagai fasilitas yang tersedia di desa
                            </p>
                            <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-success">
                                <i class="bi bi-eye me-2"></i> Lihat Fasilitas
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-calendar-check display-4 text-primary"></i>
                            </div>
                            <h4 class="card-title">Peminjaman</h4>
                            <p class="card-text text-muted">
                                Ajukan peminjaman fasilitas dengan mudah dan pantau statusnya
                            </p>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-plus-circle me-2"></i> Ajukan Peminjaman
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="icon-wrapper mb-3">
                                <i class="bi bi-people display-4 text-warning"></i>
                            </div>
                            <h4 class="card-title">Data Warga</h4>
                            <p class="card-text text-muted">
                                Kelola data warga secara terintegrasi untuk keperluan administrasi
                            </p>
                            <a href="{{ route('warga.index') }}" class="btn btn-outline-warning">
                                <i class="bi bi-person me-2"></i> Data Warga
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATISTICS SECTION -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="fw-bold text-dark">Statistik Desa</h2>
                    <p class="lead text-muted">Data terkini pengelolaan fasilitas desa</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card text-center p-4">
                        <div class="stat-icon mb-3">
                            <i class="bi bi-building fs-1 text-success"></i>
                        </div>
                        <h3 class="stat-number fw-bold">{{ $fasilitasCount ?? 8 }}</h3>
                        <p class="stat-label text-muted mb-0">Fasilitas Tersedia</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="stat-card text-center p-4">
                        <div class="stat-icon mb-3">
                            <i class="bi bi-calendar-event fs-1 text-primary"></i>
                        </div>
                        <h3 class="stat-number fw-bold">{{ $peminjamanCount ?? 24 }}</h3>
                        <p class="stat-label text-muted mb-0">Peminjaman Aktif</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="stat-card text-center p-4">
                        <div class="stat-icon mb-3">
                            <i class="bi bi-people fs-1 text-warning"></i>
                        </div>
                        <h3 class="stat-number fw-bold">{{ $wargaCount ?? 150 }}</h3>
                        <p class="stat-label text-muted mb-0">Warga Terdaftar</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="stat-card text-center p-4">
                        <div class="stat-icon mb-3">
                            <i class="bi bi-check-circle fs-1 text-info"></i>
                        </div>
                        <h3 class="stat-number fw-bold">{{ $completedCount ?? 45 }}</h3>
                        <p class="stat-label text-muted mb-0">Peminjaman Selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUICK ACTIONS -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold">Mulai Kelola Fasilitas Desa</h2>
                    <p class="lead mb-0">
                        Sistem manajemen fasilitas desa yang modern dan mudah digunakan
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-light btn-lg me-2">
                        <i class="bi bi-plus-circle me-2"></i> Ajukan Baru
                    </a>
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-search me-2"></i> Cari Fasilitas
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- UPCOMING EVENTS -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="fw-bold text-dark">Kegiatan Mendatang</h2>
                    <p class="lead text-muted">Jadwal peminjaman fasilitas dalam waktu dekat</p>
                </div>
            </div>

            <div class="row g-4">
                @for($i = 1; $i <= 3; $i++)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="date-badge bg-success text-white text-center me-3">
                                    <div class="day fs-4 fw-bold">{{ 18 + $i }}</div>
                                    <div class="month small">Des</div>
                                </div>
                                <div>
                                    <h5 class="card-title mb-0">Pemuda Karang Taruna</h5>
                                    <small class="text-muted">Lapangan Voli</small>
                                </div>
                            </div>
                            <p class="card-text text-muted">
                                Latihan rutin mingguan pemuda karang taruna desa
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">Disetujui</span>
                                <small class="text-muted">08:00 - 12:00 WIB</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('peminjaman.calendar') }}" class="btn btn-outline-primary">
                    <i class="bi bi-calendar-week me-2"></i> Lihat Kalender Lengkap
                </a>
            </div>
        </div>
    </section>

    <style>
        /* Custom Styles */
        .carousel-item {
            height: 600px;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            padding: 2rem;
            bottom: 50px;
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
        }

        .stat-card {
            transition: transform 0.3s ease;
            border-radius: 10px;
            background: #f8f9fa;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .stat-number {
            color: #2c3e50;
            font-size: 2.5rem;
        }

        .date-badge {
            width: 60px;
            padding: 10px;
            border-radius: 8px;
        }

        .icon-wrapper {
            display: inline-block;
            padding: 20px;
            border-radius: 50%;
            background: rgba(25, 135, 84, 0.1);
        }

        @media (max-width: 768px) {
            .carousel-item {
                height: 400px;
            }

            .carousel-caption {
                padding: 1rem;
                bottom: 20px;
            }

            .carousel-caption h2 {
                font-size: 1.5rem;
            }

            .carousel-caption p {
                font-size: 0.9rem;
            }
        }
    </style>

    <script>
        // Auto slide interval
        document.addEventListener('DOMContentLoaded', function() {
            const myCarousel = document.getElementById('fasilitasCarousel');
            const carousel = new bootstrap.Carousel(myCarousel, {
                interval: 3000, // Ganti slide setiap 5 detik
                wrap: true,
                pause: false
            });
        });
    </script>
@endsection
