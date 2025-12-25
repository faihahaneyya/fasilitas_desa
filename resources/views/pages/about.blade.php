@extends('layouts.guest.app')

@section('title', 'Tentang Aplikasi - Fasilitas Desa')

@section('content')
    <div class="container-fluid py-5">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="position-relative mb-4">
                <div class="system-icon-container mx-auto">
                    <img src="https://cdn-icons-png.flaticon.com/512/1995/1995515.png" alt="Sistem Fasilitas Desa"
                        class="system-icon-img">
                    <div class="icon-glow"></div>
                </div>
            </div>
            <h1 class="display-5 fw-bold text-gradient mb-3">
                Sistem Peminjaman Fasilitas Desa
            </h1>
            <p class="lead text-muted">
                Platform digital untuk mengelola peminjaman fasilitas desa secara online
            </p>
            <div class="mt-4">
                <span class="badge bg-success me-2"><i class="fas fa-check-circle me-1"></i> Transparan</span>
                <span class="badge bg-info me-2"><i class="fas fa-bolt me-1"></i> Efisien</span>
                <span class="badge bg-warning"><i class="fas fa-globe me-1"></i> Mudah Diakses</span>
            </div>
        </div>

        <!-- About Section -->
        <div class="row mb-5">
            <div class="col-md-6 mb-4">
                <div class="card about-card h-100 border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3">
                                <i class="fas fa-info-circle fa-lg"></i>
                            </div>
                            <h5 class="mb-0 fw-bold">📌 Tentang Sistem</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <p class="fs-5">
                            Sistem digital untuk mengelola peminjaman fasilitas desa seperti balai, aula,
                            dan lapangan secara online. Dibangun untuk memudahkan warga dan petugas dalam
                            proses administrasi.
                        </p>
                        <div class="mt-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-building text-primary me-3 fa-lg"></i>
                                <span>Fasilitas: Balai, Aula, Lapangan</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-users text-success me-3 fa-lg"></i>
                                <span>Pengguna: Warga & Petugas Desa</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-laptop-code text-info me-3 fa-lg"></i>
                                <span>Sistem: Terdigitalisasi & Terintegrasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card about-card h-100 border-0 shadow-lg">
                    <div class="card-header bg-success text-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3">
                                <i class="fas fa-bullseye fa-lg"></i>
                            </div>
                            <h5 class="mb-0 fw-bold">🎯 Visi & Misi</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="vision-mission-item mb-4">
                            <h6 class="fw-bold text-success mb-3">Visi:</h6>
                            <p class="mb-0 ps-4 border-start border-success border-3">
                                Menjadi platform terdepan dalam pengelolaan fasilitas desa yang transparan,
                                efisien, dan mudah diakses.
                            </p>
                        </div>
                        <div class="vision-mission-item">
                            <h6 class="fw-bold text-success mb-3">Misi:</h6>
                            <ul class="list-unstyled ps-4">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Menyediakan sistem peminjaman yang cepat dan terstruktur
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Meningkatkan akuntabilitas penggunaan fasilitas umum
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Mengoptimalkan pemanfaatan fasilitas desa secara merata
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Goals Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-info text-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3">
                                <i class="fas fa-flag fa-lg"></i>
                            </div>
                            <h5 class="mb-0 fw-bold">✅ Tujuan Sistem</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-3 col-6 mb-4">
                                <div class="goal-card text-center p-3">
                                    <div class="goal-icon mb-3">
                                        <i class="fas fa-clock text-primary fa-2x"></i>
                                    </div>
                                    <p class="fw-bold mb-0">Mempermudah warga mengajukan peminjaman tanpa antre</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-4">
                                <div class="goal-card text-center p-3">
                                    <div class="goal-icon mb-3">
                                        <i class="fas fa-calendar-alt text-success fa-2x"></i>
                                    </div>
                                    <p class="fw-bold mb-0">Mencegah penjadwalan bentrok antar kegiatan</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-4">
                                <div class="goal-card text-center p-3">
                                    <div class="goal-icon mb-3">
                                        <i class="fas fa-digital-tachograph text-warning fa-2x"></i>
                                    </div>
                                    <p class="fw-bold mb-0">Mendigitalisasi catatan administrasi fasilitas</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-4">
                                <div class="goal-card text-center p-3">
                                    <div class="goal-icon mb-3">
                                        <i class="fas fa-globe-americas text-danger fa-2x"></i>
                                    </div>
                                    <p class="fw-bold mb-0">Memberikan akses informasi fasilitas 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workflow Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-warning text-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3">
                                <i class="fas fa-sync-alt fa-lg"></i>
                            </div>
                            <h5 class="mb-0 fw-bold">🔄 Alur Penggunaan Sistem</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 workflow-container">
                            <div class="col">
                                <div class="step-item">
                                    <div class="step-number">1</div>
                                    <h6 class="fw-bold">Pilih Fasilitas</h6>
                                    <p class="small text-muted mb-2">Cek ketersediaan di menu</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="step-item">
                                    <div class="step-number">2</div>
                                    <h6 class="fw-bold">Ajukan</h6>
                                    <p class="small text-muted mb-2">Isi form peminjaman</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="step-item">
                                    <div class="step-number">3</div>
                                    <h6 class="fw-bold">Syarat</h6>
                                    <p class="small text-muted mb-2">Lengkapi dokumen</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="step-item">
                                    <div class="step-number">4</div>
                                    <h6 class="fw-bold">Verifikasi</h6>
                                    <p class="small text-muted mb-2">Tunggu tinjauan petugas</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="step-item">
                                    <div class="step-number">5</div>
                                    <h6 class="fw-bold">Bayar</h6>
                                    <p class="small text-muted mb-2">Konfirmasi pembayaran</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="step-item">
                                    <div class="step-number">6</div>
                                    <h6 class="fw-bold">Selesai</h6>
                                    <p class="small text-muted mb-2">Gunakan fasilitas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-danger text-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3">
                                <i class="fas fa-bolt fa-lg"></i>
                            </div>
                            <h5 class="mb-0 fw-bold">⚡ Fitur Utama Sistem</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="feature-main-card p-4 h-100">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="feature-icon-main me-3">
                                            <i class="fas fa-tachometer-alt text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Dashboard Real-time</h6>
                                            <p class="mb-0 text-muted">Pantau ketersediaan fasilitas secara langsung</p>
                                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary mt-2">
                                                Lihat Dashboard
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="feature-main-card p-4 h-100">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="feature-icon-main me-3">
                                            <i class="fas fa-users text-success"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Manajemen Warga</h6>
                                            <p class="mb-0 text-muted">Data peminjam terintegrasi dan terkelola</p>
                                            <a href="{{ route('warga.index') }}" class="btn btn-sm btn-success mt-2">
                                                Kelola Warga
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="feature-main-card p-4 h-100">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="feature-icon-main me-3">
                                            <i class="fas fa-calendar-week text-warning"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Kalender Peminjaman</h6>
                                            <p class="mb-0 text-muted">Hindari bentrok jadwal dengan kalender interaktif</p>
                                            <a href="{{ route('peminjaman.calendar') }}"
                                                class="btn btn-sm btn-warning text-white mt-2">
                                                Lihat Kalender
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="feature-main-card p-4 h-100">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="feature-icon-main me-3">
                                            <i class="fas fa-credit-card text-info"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Sistem Pembayaran Digital</h6>
                                            <p class="mb-0 text-muted">Catatan pembayaran otomatis dan terstruktur</p>
                                            <a href="{{ route('pembayaran-fasilitas.index') }}"
                                                class="btn btn-sm btn-info text-white mt-2">
                                                Kelola Pembayaran
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="feature-main-card p-4 h-100">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="feature-icon-main me-3">
                                            <i class="fas fa-file-alt text-danger"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Pengelolaan Syarat</h6>
                                            <p class="mb-0 text-muted">Persyaratan sesuai jenis fasilitas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="feature-main-card p-4 h-100">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="feature-icon-main me-3">
                                            <i class="fas fa-user-shield text-dark"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Role-based Access</h6>
                                            <p class="mb-0 text-muted">Admin, Petugas, dan Warga memiliki akses berbeda</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Section -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-4">
                        <h4 class="fw-bold mb-4">🚀 Mulai Gunakan Sistem</h4>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="{{ route('fasilitas.index') }}" class="btn btn-lg btn-primary">
                                <i class="fas fa-building me-2"></i> Lihat Fasilitas
                            </a>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-lg btn-success">
                                <i class="fas fa-calendar-plus me-2"></i> Ajukan Peminjaman
                            </a>
                            <a href="{{ route('dashboard') }}" class="btn btn-lg btn-info text-white">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                            <a href="{{ url('/') }}" class="btn btn-lg btn-outline-secondary">
                                <i class="fas fa-home me-2"></i> Halaman Utama
                            </a>
                        </div>
                        <p class="text-muted mt-4 mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            Sistem aktif 24/7 - Akses kapan saja, di mana saja
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* System Icon Container */
        .system-icon-container {
            width: 140px;
            height: 140px;
            position: relative;
            margin-bottom: 30px;
        }

        .system-icon-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            position: relative;
            z-index: 2;
        }

        .icon-glow {
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(135deg, rgba(25, 135, 84, 0.1), rgba(32, 201, 151, 0.1));
            border-radius: 50%;
            z-index: 1;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(135deg, #198754, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* About Cards */
        .about-card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-5px);
        }

        .about-card .card-header {
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }

        .icon-wrapper {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Goal Cards */
        .goal-card {
            background: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .goal-card:hover {
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .goal-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(13, 110, 253, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        /* Workflow Steps */
        .workflow-steps {
            display: flex;
            overflow-x: auto;
            padding: 20px 0;
            gap: 20px;
        }

        .step-item {
            flex: 0 0 auto;
            width: 180px;
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffc107, #ff6b35);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 auto 15px;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }

        .step-content {
            background: white;
            padding: 20px 15px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .step-connector {
            display: flex;
            align-items: center;
            color: #6c757d;
            font-size: 1.5rem;
        }

        /* Feature Cards */
        .feature-main-card {
            background: white;
            border-radius: 10px;
            border-left: 4px solid #0d6efd;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-main-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .feature-icon-main {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.1), rgba(25, 135, 84, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .workflow-steps {
                flex-direction: column;
                align-items: center;
            }

            .step-item {
                width: 100%;
                max-width: 300px;
            }

            .step-connector {
                transform: rotate(90deg);
                margin: 10px 0;
            }

            .step-content {
                text-align: left;
            }

            .d-flex.flex-wrap {
                flex-direction: column;
                gap: 10px;
            }

            .d-flex.flex-wrap .btn {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .system-icon-container {
                width: 100px;
                height: 100px;
            }

            .goal-card {
                padding: 15px;
            }

            .feature-main-card {
                padding: 20px;
            }
        }
    </style>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection