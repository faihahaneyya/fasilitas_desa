{{-- resources/views/pages/developer/show.blade.php --}}
@extends('layouts.guest.app')

@section('title', 'Profil Pengembang - Sistem Fasilitas Desa')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 fw-bold text-success mb-3">Identitas Pengembang</h1>
                <div class="d-flex justify-content-center mb-4">
                    <div class="border-bottom border-success" style="width: 150px; height: 4px;"></div>
                </div>
                <p class="lead text-muted">Profil Pengembang Sistem Fasilitas Desa</p>
            </div>
        </div>
    </div>

    <!-- Card Identitas Pengembang -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg developer-profile-card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <!-- Foto Pengembang -->
                        <div class="mb-4 position-relative">
                            @php
                                $photoPaths = [
                                    'assets/img/faiha.jpg',
                                    'assets/img/faiha.jpeg',
                                    'assets/img/developer.jpg',
                                    'images/faiha.jpg',
                                    'images/faiha.jpeg'
                                ];
                                $photoFound = false;
                                $photoSrc = '';

                                foreach ($photoPaths as $path) {
                                    if (file_exists(public_path($path))) {
                                        $photoFound = true;
                                        $photoSrc = asset($path);
                                        break;
                                    }
                                }
                            @endphp

                            @if($photoFound)
                                <img src="{{ $photoSrc }}"
                                     alt="Foto Faiha Haneyya"
                                     class="rounded-circle border border-4 border-success developer-photo"
                                     style="width: 200px; height: 200px; object-fit: cover;">
                            @else
                                <!-- Default avatar jika foto tidak ditemukan -->
                                <div class="rounded-circle border border-4 border-success d-inline-flex align-items-center justify-content-center bg-success text-white default-avatar"
                                     style="width: 200px; height: 200px;">
                                    <i class="fas fa-user fa-5x"></i>
                                </div>
                            @endif
                            <div class="verified-badge">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>

                        <!-- Nama dan NIM -->
                        <h2 class="fw-bold text-dark mb-2">Faiha Haneyya Arrumaisha</h2>
                        <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                            <span class="badge bg-success fs-6 p-2">
                                <i class="fas fa-id-card me-2"></i>
                                2457301043
                            </span>
                            <span class="badge bg-primary fs-6 p-2">
                                <i class="fas fa-graduation-cap me-2"></i>
                                Sistem Informasi
                            </span>
                        </div>

                        <!-- Universitas -->
                        <div class="mb-4">
                            <p class="text-muted mb-0">
                                <i class="fas fa-university me-2"></i>
                                politeknik caltex riau
                            </p>
                            <p class="text-muted mb-0">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                Pekanbaru, Indonesia
                            </p>
                        </div>
                    </div>

                    <!-- Deskripsi Singkat -->
                    <div class="mb-5">
                        <div class="quote-box p-4 mb-4">
                            <i class="fas fa-quote-left fa-2x text-success mb-3"></i>
                            <p class="fs-5 fst-italic">
                                "Pengembang utama Sistem Fasilitas Desa, berdedikasi menciptakan solusi teknologi
                                untuk membantu pengelolaan fasilitas desa secara digital dan efisien."
                            </p>
                            <i class="fas fa-quote-right fa-2x text-success float-end mt-3"></i>
                        </div>

                        <!-- Detail Tambahan -->
                        <div class="row text-center mt-4">
                            <div class="col-md-4 mb-3">
                                <div class="detail-item">
                                    <i class="fas fa-code fa-2x text-primary mb-2"></i>
                                    <h5 class="fw-bold">Web Developer</h5>
                                    <p class="text-muted small">Laravel Specialist</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-item">
                                    <i class="fas fa-project-diagram fa-2x text-success mb-2"></i>
                                    <h5 class="fw-bold">Proyek Fasilitas</h5>
                                    <p class="text-muted small">Sistem Desa Digital</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt fa-2x text-warning mb-2"></i>
                                    <h5 class="fw-bold">Bergabung</h5>
                                    <p class="text-muted small">Desember 2024</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4 text-center">
                            <i class="fas fa-network-wired me-2 text-info"></i>
                            Hubungi Saya
                        </h4>
                        <div class="row g-3 justify-content-center">
                            <!-- LinkedIn -->
                            <div class="col-6 col-md-3">
                                <a href="https://linkedin.com/in/faihahaneyya"
                                   target="_blank"
                                   class="social-card linkedin">
                                    <div class="social-icon">
                                        <i class="fab fa-linkedin fa-2x"></i>
                                    </div>
                                    <div class="social-text">
                                        <h6 class="mb-0">LinkedIn</h6>
                                        <small class="text-muted">Profesional</small>
                                    </div>
                                </a>
                            </div>

                            <!-- GitHub -->
                            <div class="col-6 col-md-3">
                                <a href="https://github.com/faihahaneyya"
                                   target="_blank"
                                   class="social-card github">
                                    <div class="social-icon">
                                        <i class="fab fa-github fa-2x"></i>
                                    </div>
                                    <div class="social-text">
                                        <h6 class="mb-0">GitHub</h6>
                                        <small class="text-muted">Repository</small>
                                    </div>
                                </a>
                            </div>

                            <!-- Instagram -->
                            <div class="col-6 col-md-3">
                                <a href="https://www.instagram.com/faihahaneyya"
                                   target="_blank"
                                   class="social-card instagram">
                                    <div class="social-icon">
                                        <i class="fab fa-instagram fa-2x"></i>
                                    </div>
                                    <div class="social-text">
                                        <h6 class="mb-0">Instagram</h6>
                                        <small class="text-muted">@faihahaneyya</small>
                                    </div>
                                </a>
                            </div>

                            <!-- Email -->
                            <div class="col-6 col-md-3">
                                <a href="mailto:cecefaiha@gmail.com"
                                   class="social-card email">
                                    <div class="social-icon">
                                        <i class="fas fa-envelope fa-2x"></i>
                                    </div>
                                    <div class="social-text">
                                        <h6 class="mb-0">Email</h6>
                                        <small class="text-muted">Kirim Pesan</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Skills/Teknologi yang digunakan -->
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4 text-center">
                            <i class="fas fa-cogs me-2 text-warning"></i>
                            Teknologi yang Digunakan
                        </h4>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <div class="tech-badge laravel">
                                <i class="fab fa-laravel me-2"></i>
                                Laravel
                            </div>
                            <div class="tech-badge bootstrap">
                                <i class="fab fa-bootstrap me-2"></i>
                                Bootstrap 5
                            </div>
                            <div class="tech-badge mysql">
                                <i class="fas fa-database me-2"></i>
                                MySQL
                            </div>
                            <div class="tech-badge js">
                                <i class="fab fa-js-square me-2"></i>
                                JavaScript
                            </div>
                            <div class="tech-badge php">
                                <i class="fab fa-php me-2"></i>
                                PHP 8+
                            </div>
                            <div class="tech-badge git">
                                <i class="fab fa-git-alt me-2"></i>
                                Git
                            </div>
                            <div class="tech-badge html">
                                <i class="fab fa-html5 me-2"></i>
                                HTML5
                            </div>
                            <div class="tech-badge css">
                                <i class="fab fa-css3-alt me-2"></i>
                                CSS3
                            </div>
                        </div>
                    </div>

                    <!-- Portfolio/Proyek -->
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4 text-center">
                            <i class="fas fa-briefcase me-2 text-danger"></i>
                            Portfolio & Proyek
                        </h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="project-card">
                                    <div class="project-icon">
                                        <i class="fas fa-building fa-2x"></i>
                                    </div>
                                    <div class="project-info">
                                        <h6 class="fw-bold mb-1">Sistem Fasilitas Desa</h6>
                                        <p class="text-muted small mb-0">Manajemen fasilitas umum desa</p>
                                        <span class="badge bg-success badge-sm">Aktif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="project-card">
                                    <div class="project-icon">
                                        <i class="fas fa-calendar-check fa-2x"></i>
                                    </div>
                                    <div class="project-info">
                                        <h6 class="fw-bold mb-1">Peminjaman Fasilitas</h6>
                                        <p class="text-muted small mb-0">Sistem booking online</p>
                                        <span class="badge bg-success badge-sm">Aktif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="project-card">
                                    <div class="project-icon">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                    <div class="project-info">
                                        <h6 class="fw-bold mb-1">Data Warga Desa</h6>
                                        <p class="text-muted small mb-0">Database kependudukan</p>
                                        <span class="badge bg-success badge-sm">Aktif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="project-card">
                                    <div class="project-icon">
                                        <i class="fas fa-money-bill-wave fa-2x"></i>
                                    </div>
                                    <div class="project-info">
                                        <h6 class="fw-bold mb-1">Pembayaran Digital</h6>
                                        <p class="text-muted small mb-0">Sistem transaksi desa</p>
                                        <span class="badge bg-success badge-sm">Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Misi dan Visi -->
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4 text-center">
                            <i class="fas fa-bullseye me-2 text-info"></i>
                            Misi & Visi
                        </h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mission-card">
                                    <div class="mission-icon">
                                        <i class="fas fa-eye fa-2x text-success"></i>
                                    </div>
                                    <div class="mission-content">
                                        <h6 class="fw-bold mb-2">Visi</h6>
                                        <p class="text-muted small mb-0">
                                            Membangun sistem digital yang memudahkan pengelolaan fasilitas desa dan meningkatkan pelayanan kepada masyarakat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mission-card">
                                    <div class="mission-icon">
                                        <i class="fas fa-rocket fa-2x text-primary"></i>
                                    </div>
                                    <div class="mission-content">
                                        <h6 class="fw-bold mb-2">Misi</h6>
                                        <p class="text-muted small mb-0">
                                            Mengembangkan aplikasi yang user-friendly, efisien, dan dapat diakses oleh seluruh warga desa.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="text-center mt-5 pt-4 border-top">
                        <a href="{{ route('about') }}" class="btn btn-outline-success btn-lg me-3">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Tentang Kami
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-home me-2"></i> Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ===== VARIABLES ===== */
    :root {
        --primary: #198754;
        --primary-light: #20c997;
        --secondary: #0dcaf0;
        --dark: #333333;
        --muted: #6c757d;
        --white: #ffffff;
        --light: #f8f9fa;
        --light-gray: #e9ecef;
        --shadow-sm: 0 5px 15px rgba(0,0,0,0.05);
        --shadow-md: 0 10px 25px rgba(0,0,0,0.1);
        --shadow-lg: 0 15px 35px rgba(0,0,0,0.15);
        --radius-sm: 10px;
        --radius-md: 15px;
        --radius-lg: 20px;
        --radius-full: 50%;
        --transition: all 0.3s ease;
    }

    /* ===== MAIN CARD ===== */
    .developer-profile-card {
        border-radius: var(--radius-lg);
        overflow: hidden;
        background: linear-gradient(135deg, var(--light) 0%, var(--light-gray) 100%);
        position: relative;
        box-shadow: var(--shadow-lg);
    }

    .developer-profile-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light), var(--secondary));
    }

    /* ===== PROFILE PHOTO SECTION ===== */
    .developer-photo {
        transition: var(--transition);
        border: 4px solid var(--primary) !important;
    }

    .developer-photo:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(25, 135, 84, 0.3);
    }

    .default-avatar {
        transition: var(--transition);
        border: 4px solid var(--primary) !important;
    }

    .default-avatar:hover {
        background: linear-gradient(135deg, var(--primary), var(--primary-light)) !important;
        transform: scale(1.05);
    }

    .verified-badge {
        position: absolute;
        bottom: 20px;
        right: calc(50% - 80px);
        background: var(--white);
        color: var(--primary);
        width: 40px;
        height: 40px;
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid var(--primary);
        box-shadow: var(--shadow-sm);
        z-index: 10;
    }

    /* ===== QUOTE BOX ===== */
    .quote-box {
        background: var(--white);
        border-radius: var(--radius-md);
        border-left: 5px solid var(--primary);
        box-shadow: var(--shadow-sm);
        position: relative;
        padding: 30px !important;
    }

    /* ===== DETAIL ITEMS ===== */
    .detail-item {
        padding: 20px;
        background: var(--white);
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        border-top: 3px solid transparent;
    }

    .detail-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-top: 3px solid var(--primary);
    }

    .detail-item i {
        transition: var(--transition);
    }

    .detail-item:hover i {
        transform: scale(1.2);
    }

    /* ===== SOCIAL CARDS ===== */
    .social-card {
        display: flex;
        align-items: center;
        text-decoration: none;
        padding: 15px;
        border-radius: var(--radius-sm);
        background: var(--white);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        color: var(--dark);
        height: 100%;
        border: 1px solid transparent;
    }

    .social-card:hover {
        transform: translateY(-5px);
        text-decoration: none;
        box-shadow: var(--shadow-md);
    }

    .social-icon {
        width: 50px;
        height: 50px;
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        transition: var(--transition);
        flex-shrink: 0;
    }

    .social-text h6 {
        margin-bottom: 3px;
        font-weight: 600;
    }

    .social-text small {
        font-size: 0.85rem;
    }

    /* Social Colors */
    .linkedin .social-icon {
        background: rgba(10, 102, 194, 0.1);
        color: #0A66C2;
    }
    .linkedin:hover {
        background: rgba(10, 102, 194, 0.05);
        border-color: rgba(10, 102, 194, 0.2);
    }

    .github .social-icon {
        background: rgba(51, 51, 51, 0.1);
        color: var(--dark);
    }
    .github:hover {
        background: rgba(51, 51, 51, 0.05);
        border-color: rgba(51, 51, 51, 0.2);
    }

    .instagram .social-icon {
        background: rgba(228, 64, 95, 0.1);
        color: #E4405F;
    }
    .instagram:hover {
        background: rgba(228, 64, 95, 0.05);
        border-color: rgba(228, 64, 95, 0.2);
    }

    .email .social-icon {
        background: rgba(212, 70, 56, 0.1);
        color: #D44638;
    }
    .email:hover {
        background: rgba(212, 70, 56, 0.05);
        border-color: rgba(212, 70, 56, 0.2);
    }

    /* ===== TECHNOLOGY BADGES ===== */
    .tech-badge {
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        margin: 5px;
        font-size: 0.9rem;
    }

    .tech-badge:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .tech-badge i {
        margin-right: 8px;
        font-size: 1.1rem;
    }

    .tech-badge.laravel {
        background: linear-gradient(135deg, #FF2D20, #FF6B6B);
        color: var(--white);
    }
    .tech-badge.bootstrap {
        background: linear-gradient(135deg, #7952B3, #A78BFA);
        color: var(--white);
    }
    .tech-badge.mysql {
        background: linear-gradient(135deg, #4479A1, #6CA6CD);
        color: var(--white);
    }
    .tech-badge.js {
        background: linear-gradient(135deg, #F7DF1E, #FFEB3B);
        color: var(--dark);
    }
    .tech-badge.php {
        background: linear-gradient(135deg, #777BB4, #A7A9D6);
        color: var(--white);
    }
    .tech-badge.git {
        background: linear-gradient(135deg, #F05032, #F47C6C);
        color: var(--white);
    }
    .tech-badge.html {
        background: linear-gradient(135deg, #E34F26, #F16529);
        color: var(--white);
    }
    .tech-badge.css {
        background: linear-gradient(135deg, #1572B6, #3399FF);
        color: var(--white);
    }

    /* ===== PROJECT CARDS ===== */
    .project-card {
        display: flex;
        align-items: center;
        padding: 20px;
        background: var(--white);
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        border-left: 4px solid var(--primary);
    }

    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }

    .project-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-full);
        background: rgba(25, 135, 84, 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        transition: var(--transition);
        flex-shrink: 0;
    }

    .project-card:hover .project-icon {
        background: rgba(25, 135, 84, 0.2);
        transform: scale(1.1);
    }

    .project-info {
        flex: 1;
    }

    .badge-sm {
        font-size: 0.7rem;
        padding: 3px 10px;
        border-radius: 20px;
    }

    /* ===== MISSION CARDS ===== */
    .mission-card {
        display: flex;
        padding: 25px;
        background: var(--white);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        border-top: 4px solid transparent;
    }

    .mission-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }

    .mission-card:nth-child(1):hover {
        border-top-color: var(--primary);
    }

    .mission-card:nth-child(2):hover {
        border-top-color: var(--secondary);
    }

    .mission-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        flex-shrink: 0;
        transition: var(--transition);
        background: rgba(25, 135, 84, 0.1);
    }

    .mission-card:nth-child(2) .mission-icon {
        background: rgba(13, 202, 240, 0.1);
    }

    .mission-card:hover .mission-icon {
        transform: rotate(10deg) scale(1.1);
    }

    .mission-content {
        flex: 1;
    }

    .mission-content h6 {
        color: var(--dark);
        margin-bottom: 10px;
    }

    /* ===== BUTTONS ===== */
    .btn-outline-success:hover {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .btn-success {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .btn-success:hover {
        background-color: #157347;
        border-color: #157347;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .social-card {
            flex-direction: column;
            text-align: center;
            padding: 15px 10px;
        }

        .social-icon {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .tech-badge {
            padding: 8px 15px;
            font-size: 0.85rem;
        }

        .project-card {
            flex-direction: column;
            text-align: center;
        }

        .project-icon {
            margin-right: 0;
            margin-bottom: 15px;
        }

        .mission-card {
            flex-direction: column;
            text-align: center;
        }

        .mission-icon {
            margin-right: 0;
            margin-bottom: 15px;
        }

        .developer-photo,
        .default-avatar {
            width: 150px !important;
            height: 150px !important;
        }

        .verified-badge {
            bottom: 10px;
            right: calc(50% - 60px);
            width: 30px;
            height: 30px;
        }

        .card-body {
            padding: 25px !important;
        }
    }

    @media (max-width: 576px) {
        .developer-profile-card {
            border-radius: var(--radius-md);
        }

        .display-4 {
            font-size: 2.5rem;
        }

        .lead {
            font-size: 1rem;
        }

        .quote-box {
            padding: 20px !important;
        }

        .detail-item {
            padding: 15px;
        }

        .tech-badge {
            padding: 6px 12px;
            font-size: 0.8rem;
            margin: 3px;
        }
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .developer-profile-card {
        animation: fadeIn 0.6s ease-out;
    }

    .detail-item, .social-card, .project-card, .mission-card {
        animation: fadeIn 0.8s ease-out;
    }
</style>

<!-- Font Awesome untuk icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection
