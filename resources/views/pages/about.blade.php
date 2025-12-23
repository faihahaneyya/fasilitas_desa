@extends('layouts.guest.app')

@section('title', 'Tentang Aplikasi - Fasilitas Desa')

@section('content')
<div class="container-fluid py-5">
    <!-- Header dengan Ilustrasi -->
    <div class="text-center mb-5">
        <div class="position-relative mb-4">
            <div class="circle-illustration-large mx-auto">
                <img src="https://cdn-icons-png.flaticon.com/512/1995/1995515.png" alt="Fasilitas Desa" class="img-fluid" style="width: 80px;">
            </div>
            <div class="floating-icons">
                <div class="floating-icon" style="top: 20px; left: 20%;">
                    <i class="bi bi-house text-primary"></i>
                </div>
                <div class="floating-icon" style="top: 40px; right: 20%;">
                    <i class="bi bi-people text-success"></i>
                </div>
                <div class="floating-icon" style="bottom: 20px; left: 25%;">
                    <i class="bi bi-calendar text-warning"></i>
                </div>
                <div class="floating-icon" style="bottom: 40px; right: 25%;">
                    <i class="bi bi-cash text-danger"></i>
                </div>
            </div>
        </div>
        <h1 class="display-5 fw-bold text-success mb-3">
            Aplikasi Pengelolaan Fasilitas dan Pelayanan Warga Desa
        </h1>
        <p class="lead text-muted">Sistem terintegrasi untuk administrasi desa digital</p>
    </div>

    <!-- Overview Section dengan Gambar -->
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <div class="illustration-container mb-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Tentang Aplikasi" class="illustration-img">
                    </div>
                    <h4 class="fw-bold text-info mb-0">Tentang Aplikasi</h4>
                </div>
                <div class="col-md-9">
                    <div class="feature-card p-4">
                        <p class="fs-5 mb-3">
                            Sistem Fasilitas Desa adalah platform digital yang dirancang untuk memudahkan pengelolaan
                            fasilitas umum, peminjaman barang, dan administrasi warga di lingkungan desa.
                        </p>
                        <p class="mb-0 fs-5">
                            Dengan sistem ini, seluruh proses administrasi dapat dilakukan secara terdigitalisasi,
                            transparan, dan efisien.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <h2 class="fw-bold text-center mb-5">
        <div class="icon-title">
            <i class="bi bi-stars text-warning"></i>
        </div>
        Fitur Unggulan
    </h2>

    <!-- Feature 1: Data Warga -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-4 text-center">
            <div class="feature-image-container mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Data Warga" class="feature-image">
                <div class="feature-badge">101+</div>
            </div>
            <h4 class="fw-bold mb-3">Data Warga</h4>
        </div>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <p class="fs-5 mb-3">
                        Kelola data seluruh warga desa secara terpusat. Tersedia informasi lengkap
                        seperti NIK, agama, pekerjaan, kontak, dan data penting lainnya.
                    </p>
                    <div class="feature-points">
                        <div class="point-item">
                            <div class="point-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <span>Total: 101 warga terdaftar</span>
                        </div>
                        <div class="point-item">
                            <div class="point-icon">
                                <i class="bi bi-search"></i>
                            </div>
                            <span>Pencarian cepat dan akurat</span>
                        </div>
                        <div class="point-item">
                            <div class="point-icon">
                                <i class="bi bi-arrow-clockwise"></i>
                            </div>
                            <span>Update data real-time</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('warga.index') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-right me-2"></i> Akses Data Warga
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature 2: Peminjaman Fasilitas -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-4 text-center order-md-2">
            <div class="feature-image-container mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/3652/3652191.png" alt="Peminjaman Fasilitas" class="feature-image">
                <div class="feature-badge bg-success">✓</div>
            </div>
            <h4 class="fw-bold mb-3">Peminjaman Fasilitas</h4>
        </div>
        <div class="col-md-8 order-md-1">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <p class="fs-5 mb-3">
                        Sistem peminjaman fasilitas umum desa seperti aula, lapangan, dan peralatan.
                        Dilengkapi dengan kalender peminjaman dan tracking status.
                    </p>
                    <div class="feature-points">
                        <div class="point-item">
                            <div class="point-icon">
                                <i class="bi bi-calendar-week"></i>
                            </div>
                            <span>Kalender peminjaman interaktif</span>
                        </div>
                        <div class="point-item">
                            <div class="point-icon">
                                <i class="bi bi-tags"></i>
                            </div>
                            <span>Multi-status peminjaman</span>
                        </div>
                        <div class="point-item">
                            <div class="point-icon">
                                <i class="bi bi-bell"></i>
                            </div>
                            <span>Notifikasi & reminder otomatis</span>
                        </div>
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-success">
                            <i class="bi bi-list me-2"></i> Lihat Peminjaman
                        </a>
                        <a href="{{ route('peminjaman.calendar') }}" class="btn btn-outline-success">
                            <i class="bi bi-calendar-week me-2"></i> Kalender
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature 3: Fasilitas Umum -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-4 text-center">
            <div class="feature-image-container mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/619/619032.png" alt="Fasilitas Umum" class="feature-image">
                <div class="feature-badge bg-warning">10+</div>
            </div>
            <h4 class="fw-bold mb-3">Fasilitas Umum</h4>
        </div>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <p class="fs-5 mb-3">
                        Inventarisasi dan pengelolaan fasilitas umum yang dimiliki desa.
                        Setiap fasilitas dilengkapi informasi kapasitas, kondisi, dan ketersediaan.
                    </p>
                    <div class="feature-points">
                        <div class="point-item">
                            <div class="point-icon">
                                <i class="bi bi-list-check"></i>
                            </div>
                            <span>Daftar fasilitas lengkap</span>
                        </div>
                        <div class="point-item">
                            <div class="point-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <span>Status ketersediaan real-time</span>
                        </div>
                        <div class="point-item">
                            <div class="point-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <span>History pemakaian terperinci</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('fasilitas.index') }}" class="btn btn-warning text-white">
                            <i class="bi bi-arrow-right me-2"></i> Lihat Fasilitas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Features Grid -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 text-center feature-card-small">
                <div class="card-body p-4">
                    <div class="feature-icon-container mb-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="Sistem Pembayaran" class="feature-icon">
                    </div>
                    <h5 class="fw-bold mb-3">Sistem Pembayaran</h5>
                    <p class="text-muted mb-4">
                        Kelola pembayaran sewa fasilitas dan iuran warga secara digital dengan tracking pembayaran.
                    </p>
                    <a href="{{ route('pembayaran-fasilitas.index') }}" class="btn btn-danger">
                        <i class="bi bi-credit-card me-2"></i> Kelola Pembayaran
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 text-center feature-card-small">
                <div class="card-body p-4">
                    <div class="feature-icon-container mb-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135760.png" alt="Dashboard & Laporan" class="feature-icon">
                    </div>
                    <h5 class="fw-bold mb-3">Dashboard & Laporan</h5>
                    <p class="text-muted mb-4">
                        Akses dashboard statistik dan laporan lengkap untuk monitoring kegiatan desa.
                    </p>
                    <a href="{{ route('dashboard') }}" class="btn btn-info text-white">
                        <i class="bi bi-speedometer2 me-2"></i> Lihat Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section dengan Ikon -->
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body p-5">
            <h3 class="fw-bold text-center mb-5">
                <div class="icon-title">
                    <i class="bi bi-bar-chart text-success"></i>
                </div>
                Statistik Sistem
            </h3>
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-icon-container">
                        <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Warga" class="stat-icon">
                    </div>
                    <h2 class="fw-bold text-primary mt-3">101</h2>
                    <p class="text-muted mb-0">Warga Terdaftar</p>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-icon-container">
                        <img src="https://cdn-icons-png.flaticon.com/512/3652/3652191.png" alt="Peminjaman" class="stat-icon">
                    </div>
                    <h2 class="fw-bold text-success mt-3">{{ \App\Models\PeminjamanFasilitas::count() ?? '0' }}</h2>
                    <p class="text-muted mb-0">Total Peminjaman</p>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-icon-container">
                        <img src="https://cdn-icons-png.flaticon.com/512/619/619032.png" alt="Fasilitas" class="stat-icon">
                    </div>
                    <h2 class="fw-bold text-warning mt-3">{{ \App\Models\FasilitasUmum::count() ?? '0' }}</h2>
                    <p class="text-muted mb-0">Fasilitas Tersedia</p>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-icon-container">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="Transaksi" class="stat-icon">
                    </div>
                    <h2 class="fw-bold text-danger mt-3">Rp {{ number_format(\App\Models\PeminjamanFasilitas::sum('total_biaya') ?? 0, 0, ',', '.') }}</h2>
                    <p class="text-muted mb-0">Total Transaksi</p>
                </div>
            </div>
        </div>
        <!-- SECTION: KENALI PENGEMBANG -->
<div class="row justify-content-center mb-5">
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg developer-intro-card">
            <div class="card-body p-5 text-center">
                <div class="developer-badge mb-4">
                    <div class="badge-circle">
                        <i class="fas fa-code fa-2x"></i>
                    </div>
                </div>

                <h3 class="fw-bold text-dark mb-3">
                    <span class="text-success">Dikembangkan Oleh</span><br>
                    Faiha Haneyya Arrumaisha
                </h3>

                <div class="developer-info mb-4">
                    <p class="text-muted mb-2">
                        <i class="fas fa-graduation-cap me-2 text-primary"></i>
                        Mahasiswa Sistem Informasi - Universitas Mercu Buana
                    </p>
                    <p class="text-muted mb-2">
                        <i class="fas fa-id-card me-2 text-warning"></i>
                        NIM: 2457301103
                    </p>
                    <p class="text-muted">
                        <i class="fas fa-calendar-alt me-2 text-success"></i>
                        Proyek ini dikembangkan sejak Desember 2024
                    </p>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <!-- TOMBOL KE HALAMAN PENGEMBANG -->
                    <a href="{{ url('/developer') }}"
                       class="btn-developer btn-lg">
                        <i class="fas fa-user-tie me-2"></i>
                        Lihat Profil Pengembang
                    </a>

                    <a href="mailto:cecefaiha@gmail.com"
                       class="btn-outline-developer btn-lg">
                        <i class="fas fa-envelope me-2"></i>
                        Hubungi Developer
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section dengan Tombol -->
<div class="text-center mt-5 pt-5 border-top">
    <h5 class="fw-bold mb-4">Akses Menu Lainnya</h5>
    <div class="d-flex flex-wrap justify-content-center gap-3 footer-buttons">
        <a href="{{ url('/') }}" class="btn btn-success">
            <i class="fas fa-home me-2"></i> Halaman Utama
        </a>
        <a href="{{ url('/developer') }}" class="btn btn-outline-success">
            <i class="fas fa-user me-2"></i> Profil Developer
        </a>
    </div>
</div>
    </div>

    <!-- Technology Stack dengan Logo -->
    <div class="text-center">
        <div class="icon-title mb-3">
            <i class="bi bi-cpu text-dark"></i>
        </div>
        <h4 class="fw-bold mb-4">Dibangun Dengan Teknologi Terkini</h4>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <div class="tech-logo">
                <img src="https://cdn-icons-png.flaticon.com/512/5969/5968322.png" alt="Laravel" class="tech-img">
                <span class="d-block mt-2 fw-bold">Laravel</span>
            </div>
            <div class="tech-logo">
                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968332.png" alt="PHP" class="tech-img">
                <span class="d-block mt-2 fw-bold">PHP 8+</span>
            </div>
            <div class="tech-logo">
                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968313.png" alt="MySQL" class="tech-img">
                <span class="d-block mt-2 fw-bold">MySQL</span>
            </div>
            <div class="tech-logo">
                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968672.png" alt="Bootstrap" class="tech-img">
                <span class="d-block mt-2 fw-bold">Bootstrap 5</span>
            </div>
            <div class="tech-logo">
                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968292.png" alt="JavaScript" class="tech-img">
                <span class="d-block mt-2 fw-bold">JavaScript</span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Illustration Styles */
    .circle-illustration-large {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #198754, #20c997);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(25, 135, 84, 0.2);
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .floating-icons {
        position: relative;
        height: 200px;
        width: 100%;
        margin-top: -100px;
    }

    .floating-icon {
        position: absolute;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        animation: float 3s ease-in-out infinite;
    }

    .floating-icon:nth-child(2) { animation-delay: 0.5s; }
    .floating-icon:nth-child(3) { animation-delay: 1s; }
    .floating-icon:nth-child(4) { animation-delay: 1.5s; }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Feature Images */
    .feature-image-container {
        position: relative;
        display: inline-block;
    }

    .feature-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .feature-image:hover {
        transform: scale(1.1);
    }

    .feature-badge {
        position: absolute;
        top: 0;
        right: 0;
        background: #0d6efd;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        box-shadow: 0 3px 10px rgba(13, 110, 253, 0.3);
    }

    .feature-badge.bg-success { background: #198754; }
    .feature-badge.bg-warning { background: #ffc107; }

    /* Feature Points */
    .feature-points {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .point-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .point-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #198754;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Small Feature Cards */
    .feature-card-small {
        transition: all 0.3s ease;
    }

    .feature-card-small:hover {
        transform: translateY(-10px);
    }

    .feature-icon-container {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        padding: 15px;
    }

    .feature-icon {
        width: 100%;
        height: auto;
    }

    /* Stats Section */
    .stat-icon-container {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        padding: 15px;
        transition: transform 0.3s ease;
    }

    .stat-icon-container:hover {
        transform: scale(1.1);
    }

    .stat-icon {
        width: 100%;
        height: auto;
    }

    /* Technology Logos */
    .tech-logo {
        text-align: center;
        padding: 15px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        min-width: 120px;
    }

    .tech-logo:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .tech-img {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }

    /* Icon Title */
    .icon-title {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .icon-title i {
        font-size: 1.5rem;
    }

    /* Illustration Container */
    .illustration-container {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .illustration-img {
        width: 100%;
        height: auto;
    }

    /* Feature Card */
    .feature-card {
        background: white;
        border-radius: 15px;
        border-left: 5px solid #0dcaf0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .circle-illustration-large {
            width: 120px;
            height: 120px;
        }

        .feature-image {
            width: 100px;
            height: 100px;
        }

        .tech-logo {
            min-width: 100px;
        }
    }
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection
