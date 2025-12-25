<!-- START NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-dark" id="navbar-sticky">
    <div class="container">
        <!-- LOGO DENGAN GAMBAR -->
        <a class="navbar-brand logo" href="{{ route('dashboard') }}">
            <!-- Logo Gambar -->
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Fasilitas Desa" height="65" class="me-2">
            <!-- Nama Aplikasi (bisa dihide di mobile jika perlu) -->
            <span class="d-none d-md-inline">Fasilitas Desa</span>
        </a>

        <!-- Responsive menu button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mx-auto" id="mySidenav">
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
                                <i class="bi bi-person me-2"></i> User
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('syarat.index') }}">
                                <i class="bi bi-list-check me-2"></i> Syarat Fasilitas
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('petugas.index') }}">
                                <i class="bi bi-person-badge me-2"></i> Petugas Fasilitas
                            </a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link">
                        <i class="bi bi-info-circle d-lg-none me-1"></i> Tentang
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-success px-4">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->