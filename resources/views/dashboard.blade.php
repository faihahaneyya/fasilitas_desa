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
                    <img src="https://images.unsplash.com/photo-1559628233-eb1b1a45564b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80"
                        class="d-block w-100" alt="Suasana Desa Indonesia">
                    <div class="carousel-caption d-none d-md-block"
                        style="background: rgba(0,0,0,0.5); border-radius: 15px; padding: 20px;">
                        <h2 class="display-5 fw-bold">Balai Desa</h2>
                        <p class="lead">Pusat kegiatan masyarakat dan musyawarah warga desa.</p>
                        <a href="{{ route('fasilitas.index') }}" class="btn btn-success btn-lg">Lihat Fasilitas</a>
                    </div>
                </div>

                <!-- Slide 2: Lapangan Olahraga -->
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1535131749006-b7f58c99034b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80"
                        class="d-block w-100" alt="Lapangan Olahraga" style="height: 600px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-5 fw-bold">Lapangan Olahraga</h2>
                        <p class="lead">Fasilitas olahraga untuk kesehatan dan kebugaran warga</p>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-primary btn-lg">Ajukan Peminjaman</a>
                    </div>
                </div>

                <!-- Slide 3: Perpustakaan Desa -->
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80"
                        class="d-block w-100" alt="Perpustakaan Desa" style="height: 600px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-5 fw-bold">Perpustakaan Desa</h2>
                        <p class="lead">Sumber ilmu pengetahuan dan literasi masyarakat</p>
                        <a href="{{ route('fasilitas.index') }}" class="btn btn-warning btn-lg">Eksplor Fasilitas</a>
                    </div>
                </div>

                <!-- Slide 4: Posyandu -->
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80"
                        class="d-block w-100" alt="Posyandu" style="height: 600px; object-fit: cover;">
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

            <!-- SECTION: KENALI PENGEMBANG -->
            <div class="row justify-content-center mb-5 mt-5">
                <div class="col-lg-9">
                    <div class="card border-0 shadow-lg developer-intro-card overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <!-- Bagian Foto Developer -->
                                <div
                                    class="col-md-4 bg-gradient-primary d-flex align-items-center justify-content-center p-5">
                                    <div class="text-center">
                                        <div class="developer-photo-wrapper mb-3">
                                            <img src="{{ asset('assets/images/cece.jpeg') }}" alt="Faiha Haneyya Arrumaisha"
                                                class="developer-photo img-fluid rounded-circle shadow-lg"
                                                onerror="this.src='https://ui-avatars.com/api/?name=Faiha+Haneyya&size=300&background=28a745&color=fff&bold=true'">
                                            <div class="photo-badge">
                                                <i class="fas fa-code"></i>
                                            </div>
                                        </div>
                                        <div class="developer-badge-icon">
                                            <i class="fas fa-award text-warning fa-2x"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bagian Informasi Developer -->
                                <div class="col-md-8 p-5">
                                    <div class="developer-content">
                                        <div class="mb-4">
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 mb-3">
                                                <i class="fas fa-laptop-code me-2"></i>Full Stack Developer
                                            </span>
                                            <h2 class="fw-bold text-dark mb-2">
                                                Faiha Haneyya Arrumaisha
                                            </h2>
                                            <p class="text-muted fst-italic">
                                                "Mengembangkan solusi digital yang inovatif dan berdampak"
                                            </p>
                                        </div>

                                        <div class="developer-info-grid mb-4">
                                            <div class="info-item">
                                                <div class="info-icon bg-primary bg-opacity-10">
                                                    <i class="fas fa-graduation-cap text-primary"></i>
                                                </div>
                                                <div class="info-text">
                                                    <small class="text-muted d-block">Program Studi</small>
                                                    <strong>Sistem Informasi</strong>
                                                    <p class="mb-0 small text-muted">Universitas Mercu Buana</p>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon bg-warning bg-opacity-10">
                                                    <i class="fas fa-id-card text-warning"></i>
                                                </div>
                                                <div class="info-text">
                                                    <small class="text-muted d-block">NIM</small>
                                                    <strong>2457301103</strong>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon bg-success bg-opacity-10">
                                                    <i class="fas fa-calendar-alt text-success"></i>
                                                </div>
                                                <div class="info-text">
                                                    <small class="text-muted d-block">Periode Pengembangan</small>
                                                    <strong>Desember 2024 - Sekarang</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Social Media Links -->
                                        <div class="social-media-section mb-4">
                                            <h6 class="text-muted mb-3">Temui Saya di:</h6>
                                            <div class="d-flex gap-2 social-icons">
                                                <!-- LinkedIn -->
                                                <a href="https://linkedin.com/in/namadeveloper" target="_blank"
                                                    class="social-icon linkedin" title="LinkedIn Profile"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="fab fa-linkedin-in"></i>
                                                    <span class="social-tooltip">LinkedIn</span>
                                                </a>

                                                <!-- Instagram -->
                                                <a href="https://instagram.com/namadeveloper" target="_blank"
                                                    class="social-icon instagram" title="Instagram Profile"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="fab fa-instagram"></i>
                                                    <span class="social-tooltip">Instagram</span>
                                                </a>

                                                <!-- GitHub -->
                                                <a href="https://github.com/faihahaneyya" target="_blank"
                                                    class="social-icon github" title="GitHub Profile"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="fab fa-github"></i>
                                                    <span class="social-tooltip">GitHub</span>
                                                </a>

                                                <!-- Email (Existing) -->
                                                <a href="mailto:faiha24si@gmail.com" class="social-icon email"
                                                    title="Email Developer" data-bs-toggle="tooltip"
                                                    data-bs-placement="top">
                                                    <i class="fas fa-envelope"></i>
                                                    <span class="social-tooltip">Email</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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

    <style>
        /* Social Media Section */
        .social-media-section {
            padding: 1rem;
            background: linear-gradient(135deg, rgba(248, 249, 250, 0.5), rgba(233, 236, 239, 0.3));
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .social-media-section h6 {
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        /* Social Icons Container */
        .social-icons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Individual Social Icon */
        .social-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }

        /* Tooltip Styling */
        .social-tooltip {
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s, bottom 0.3s;
            pointer-events: none;
        }

        .social-icon:hover .social-tooltip {
            opacity: 1;
            bottom: -25px;
        }

        /* LinkedIn Icon */
        .social-icon.linkedin {
            background: linear-gradient(135deg, #0077B5, #00A0DC);
            color: white;
        }

        .social-icon.linkedin:hover {
            background: linear-gradient(135deg, #005582, #0084B4);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 119, 181, 0.3);
        }

        /* Instagram Icon */
        .social-icon.instagram {
            background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
            color: white;
            background-size: 300% 300%;
            animation: gradient 3s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .social-icon.instagram:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 12px rgba(225, 48, 108, 0.3);
            animation: none;
            background: linear-gradient(45deg, #C13584, #E1306C, #FD1D1D);
        }

        /* GitHub Icon */
        .social-icon.github {
            background: linear-gradient(135deg, #333333, #24292e);
            color: white;
        }

        .social-icon.github:hover {
            background: linear-gradient(135deg, #24292e, #000000);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 12px rgba(36, 41, 46, 0.3);
        }

        /* Email Icon */
        .social-icon.email {
            background: linear-gradient(135deg, #198754, #20c997);
            color: white;
        }

        .social-icon.email:hover {
            background: linear-gradient(135deg, #157347, #198754);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 12px rgba(25, 135, 84, 0.3);
        }

        /* Portfolio Icon */
        .social-icon.portfolio {
            background: linear-gradient(135deg, #6f42c1, #8a63d2);
            color: white;
        }

        .social-icon.portfolio:hover {
            background: linear-gradient(135deg, #5a32a3, #6f42c1);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 12px rgba(111, 66, 193, 0.3);
        }

        /* Icon Size */
        .social-icon i {
            font-size: 1.25rem;
            transition: transform 0.3s;
        }

        .social-icon:hover i {
            transform: scale(1.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .social-media-section {
                padding: 0.75rem;
            }

            .social-icon {
                width: 46px;
                height: 46px;
            }

            .social-icon i {
                font-size: 1.1rem;
            }

            .social-icons {
                justify-content: center;
            }

            .d-flex.flex-wrap.gap-3 {
                justify-content: center;
            }

            .d-flex.flex-wrap.gap-3 .btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .social-icon {
                width: 42px;
                height: 42px;
            }

            .social-icon i {
                font-size: 1rem;
            }

            .social-tooltip {
                font-size: 0.7rem;
                padding: 3px 6px;
            }
        }
    </style>

    <!-- Initialize Bootstrap Tooltips -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
    <script>
        // Auto slide interval
        document.addEventListener('DOMContentLoaded', function () {
            const myCarousel = document.getElementById('fasilitasCarousel');
            const carousel = new bootstrap.Carousel(myCarousel, {
                interval: 3000, // Ganti slide setiap 5 detik
                wrap: true,
                pause: false
            });
        });
    </script>
@endsection