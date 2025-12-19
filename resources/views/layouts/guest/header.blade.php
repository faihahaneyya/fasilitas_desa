<!-- START NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-dark" id="navbar-sticky">
    <div class="container">
        <!-- LOGO DENGAN GAMBAR -->
        <a class="navbar-brand logo" href="{{ route('dashboard') }}">
            <!-- Logo Gambar -->
            <img src="{{ asset('assets/images/logo.png') }}"
                 alt="Logo Fasilitas Desa"
                 height="65"
                 class="me-2">
            <!-- Nama Aplikasi (bisa dihide di mobile jika perlu) -->
            <span class="d-none d-md-inline">Fasilitas Desa</span>
        </a>

        <!-- Responsive menu button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav navbar-center nav-custom-left" id="mySidenav">
                <!-- Home Dropdown -->
                <li class="dropdown nav-item">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-house-door d-lg-none me-1"></i> Home
                    </a>
                    <ul class="dropdown-menu arrow" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                            <i class="bi bi-house me-2"></i> Beranda
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('warga.index') }}">
                            <i class="bi bi-people me-2"></i> Warga
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('fasilitas.index') }}">
                            <i class="bi bi-building me-2"></i> Fasilitas Umum
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('peminjaman.index') }}">
                            <i class="bi bi-calendar-check me-2"></i> Peminjaman
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('pembayaran-fasilitas.index') }}">
                            <i class="bi bi-cash-coin me-2"></i> Pembayaran
                        </a></li>

                        <li><a class="dropdown-item" href="{{ route('users.index') }}">
                            <i class="bi bi-cash-coin me-2"></i> User
                        </a></li>
                    </ul>
                </li>

                <!-- Menu Tentang (TAMBAHKAN INI) -->
                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link">
                        <i class="bi bi-info-circle d-lg-none me-1"></i> Tentang
                    </a>
                </li>



                <!-- Menu Plans -->
                <li class="nav-item">
                    <a href="#pricing" class="nav-link">
                        <i class="bi bi-credit-card d-lg-none me-1"></i> Plans
                    </a>
                </li>

                <!-- Menu Clients -->
                <li class="nav-item">
                    <a href="#clients" class="nav-link">
                        <i class="bi bi-people d-lg-none me-1"></i> Clients
                    </a>
                </li>

                <!-- Pages Dropdown -->
                <li class="dropdown nav-item">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-files d-lg-none me-1"></i> Pages
                    </a>
                    <ul class="dropdown-menu arrow" aria-labelledby="navbarDropdown">
                        <!-- Link Tentang juga ada di sini -->
                        <li><a class="dropdown-item" href="{{ route('about') }}">
                            <i class="bi bi-info-circle me-2"></i> Tentang Kami
                        </a></li>
                        <li><a class="dropdown-item" href="contact.html">
                            <i class="bi bi-envelope me-2"></i> Kontak
                        </a></li>
                        <li><a class="dropdown-item" href="faq.html">
                            <i class="bi bi-question-circle me-2"></i> FAQ
                        </a></li>
                        <li><a class="dropdown-item" href="jobs.html">
                            <i class="bi bi-briefcase me-2"></i> Jobs
                        </a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right ms-auto">
                @auth
                    {{-- Jika user sudah login --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">
                                <i class="bi bi-person me-2"></i> Profil
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="bi bi-gear me-2"></i> Pengaturan
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Jika user belum login --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-success navbar-btn nav-link">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->
