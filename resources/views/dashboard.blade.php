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
                    <h2 class="fw-bold text-primary display-5">Fasilitas Desa Kita</h2>
                    <p class="lead text-muted fs-4">Kelola dan manfaatkan fasilitas desa dengan mudah melalui sistem kami</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-lg h-100 feature-card" style="border-top: 5px solid #28a745;">
                        <div class="card-body text-center p-5">
                            <!-- Icon Bulat untuk Fasilitas Umum -->
                            <div class="circle-icon-wrapper mb-4">
                                <div class="circle-icon bg-success">
                                    <i class="fas fa-landmark fa-2x text-white"></i>
                                </div>
                            </div>
                            <h4 class="card-title fw-bold mb-3">Fasilitas Umum</h4>
                            <p class="card-text text-muted fs-5 mb-4">
                                Akses informasi lengkap tentang berbagai fasilitas yang tersedia di desa
                            </p>
                            <div class="feature-action">
                                <h5 class="feature-label text-success fw-bold">LIHAT FASILITAS</h5>
                                <div class="feature-line mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-lg h-100 feature-card" style="border-top: 5px solid #007bff;">
                        <div class="card-body text-center p-5">
                            <!-- Icon Bulat untuk Peminjaman -->
                            <div class="circle-icon-wrapper mb-4">
                                <div class="circle-icon bg-primary">
                                    <i class="fas fa-calendar-alt fa-2x text-white"></i>
                                </div>
                            </div>
                            <h4 class="card-title fw-bold mb-3">Peminjaman</h4>
                            <p class="card-text text-muted fs-5 mb-4">
                                Ajukan peminjaman fasilitas dengan mudah dan pantau statusnya
                            </p>
                            <div class="feature-action">
                                <h5 class="feature-label text-primary fw-bold">AJUKAN PEMINJAMAN</h5>
                                <div class="feature-line mt-2 bg-primary"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-lg h-100 feature-card" style="border-top: 5px solid #ffc107;">
                        <div class="card-body text-center p-5">
                            <!-- Icon Bulat untuk Data Warga -->
                            <div class="circle-icon-wrapper mb-4">
                                <div class="circle-icon bg-warning">
                                    <i class="fas fa-users fa-2x text-white"></i>
                                </div>
                            </div>
                            <h4 class="card-title fw-bold mb-3">Data Warga</h4>
                            <p class="card-text text-muted fs-5 mb-4">
                                Kelola data warga secara terintegrasi untuk keperluan administrasi
                            </p>
                            <div class="feature-action">
                                <h5 class="feature-label text-warning fw-bold">DATA WARGA</h5>
                                <div class="feature-line mt-2 bg-warning"></div>
                            </div>
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
                                                    <p class="mb-0 small text-muted">Politeknik Caltex Riau</p>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon bg-warning bg-opacity-10">
                                                    <i class="fas fa-id-card text-warning"></i>
                                                </div>
                                                <div class="info-text">
                                                    <small class="text-muted d-block">NIM</small>
                                                    <strong>2457301043</strong>
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
            height: 70vh;
            min-height: 500px;
            max-height: 700px;
        }

        .carousel-item img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 15px;
            padding: 1.5rem 2rem;
            bottom: 60px;
            max-width: 700px;
            margin: 0 auto;
            left: 50%;
            transform: translateX(-50%);
        }

        .carousel-caption h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .carousel-caption p {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
            background-color: rgba(255, 255, 255, 0.5);
        }

        .carousel-indicators button.active {
            background-color: white;
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

        /* Feature Section Custom Styles */
        .feature-card {
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
        }

        .feature-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
            z-index: 2;
        }

        /* Circle Icon Styles */
        .circle-icon-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .circle-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .circle-icon::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .circle-icon:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .circle-icon:hover::before {
            opacity: 1;
        }

        .circle-icon.bg-success {
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .circle-icon.bg-primary {
            background: linear-gradient(135deg, #007bff, #0dcaf0);
        }

        .circle-icon.bg-warning {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
        }

        .circle-icon i {
            position: relative;
            z-index: 1;
        }

        .feature-action {
            padding-top: 1rem;
            position: relative;
        }

        .feature-label {
            font-size: 1.1rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
            padding: 0 1rem;
        }

        .feature-line {
            height: 3px;
            width: 60px;
            background: #28a745;
            margin: 0 auto;
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .feature-card:hover .feature-line {
            width: 100px;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.8);
                opacity: 0.7;
            }
            50% {
                transform: scale(1);
                opacity: 0.3;
            }
            100% {
                transform: scale(0.8);
                opacity: 0.7;
            }
        }

        @media (max-width: 992px) {
            .carousel-item {
                height: 60vh;
                min-height: 450px;
                max-height: 600px;
            }

            .carousel-caption h2 {
                font-size: 2rem;
            }

            .carousel-caption p {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 768px) {
            .carousel-item {
                height: 50vh;
                min-height: 400px;
                max-height: 500px;
            }

            .carousel-caption {
                padding: 1rem 1.5rem;
                bottom: 40px;
                width: 90%;
            }

            .carousel-caption h2 {
                font-size: 1.75rem;
                margin-bottom: 0.75rem;
            }

            .carousel-caption p {
                font-size: 1rem;
                margin-bottom: 1rem;
            }

            .circle-icon {
                width: 80px;
                height: 80px;
            }

            .circle-icon i {
                font-size: 1.5rem !important;
            }

            .card-body {
                padding: 1.5rem !important;
            }
        }

        @media (max-width: 576px) {
            .carousel-item {
                height: 45vh;
                min-height: 350px;
                max-height: 450px;
            }

            .carousel-caption {
                padding: 0.75rem 1rem;
                bottom: 30px;
            }

            .carousel-caption h2 {
                font-size: 1.5rem;
            }

            .carousel-caption p {
                font-size: 0.9rem;
            }

            .carousel-caption .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
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
