<!-- STRAT NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-dark" id="navbar-sticky">
    <div class="container">
        <!-- LOGO -->
        <a class="navbar-brand logo" href="index.html">
            Fasilitas Desa
        </a>

        <!-- Responsive menu button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav navbar-center nav-custom-left" id="mySidenav">
                <li class="dropdown nav-item">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
                    <ul class="dropdown-menu arrow" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('warga.index')}}">Warga</a></li>
                        <li><a class="dropdown-item" href="{{route(name: 'fasilitas.index')}}">Fasilitas Umum</a></li>
                        <li><a class="dropdown-item" href="{{route(name: 'peminjaman.index')}}">Peminjaman Fasilitas</a></li>
                        <li><a class="dropdown-item" href="{{route(name: 'pembayaran-fasilitas.index')}}">Pembayaran Fasilitas</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#features" class="nav-link">Features</a>
                </li>
                <li class="nav-item">
                    <a href="#pricing" class="nav-link">Plans</a>
                </li>
                <li class="nav-item">
                    <a href="#clients" class="nav-link">Clients</a>
                </li>
                <li class="dropdown nav-item">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Pages</a>
                    <ul class="dropdown-menu arrow" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="about-us.html">About Us</a></li>
                        <li><a class="dropdown-item" href="contact.html">Contact</a></li>
                        <li><a class="dropdown-item" href="faq.html">FAQ</a></li>
                        <li><a class="dropdown-item" href="jobs.html">Jobs</a></li>
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
