<!-- FOOTER -->
<footer class="section bg-gray footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="circle-icon-sm bg-success me-3">
                        <i class="bi bi-house-heart text-white"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Fasilitas Desa</h5>
                </div>
                <p class="text-muted mb-3">
                    Sistem digital untuk pengelolaan fasilitas dan administrasi warga desa.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="circle-social-icon" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="circle-social-icon" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="circle-social-icon" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="circle-social-icon" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="circle-icon-sm bg-primary me-3">
                        <i class="bi bi-menu-app text-white"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Menu Utama</h5>
                </div>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark d-flex align-items-center">
                            <div class="circle-icon-xs bg-primary bg-opacity-10 me-2">
                                <i class="bi bi-house-door text-primary"></i>
                            </div>
                            Beranda
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('about') }}" class="text-decoration-none text-dark d-flex align-items-center">
                            <div class="circle-icon-xs bg-info bg-opacity-10 me-2">
                                <i class="bi bi-info-circle text-info"></i>
                            </div>
                            Tentang Aplikasi
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('warga.index') }}" class="text-decoration-none text-dark d-flex align-items-center">
                            <div class="circle-icon-xs bg-success bg-opacity-10 me-2">
                                <i class="bi bi-people text-success"></i>
                            </div>
                            Data Warga
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('fasilitas.index') }}" class="text-decoration-none text-dark d-flex align-items-center">
                            <div class="circle-icon-xs bg-warning bg-opacity-10 me-2">
                                <i class="bi bi-building text-warning"></i>
                            </div>
                            Fasilitas Umum
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="circle-icon-sm bg-warning me-3">
                        <i class="bi bi-gear text-white"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Layanan</h5>
                </div>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('peminjaman.index') }}" class="text-decoration-none text-dark d-flex align-items-center">
                            <div class="circle-icon-xs bg-success bg-opacity-10 me-2">
                                <i class="bi bi-calendar-check text-success"></i>
                            </div>
                            Peminjaman Fasilitas
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('pembayaran-fasilitas.index') }}" class="text-decoration-none text-dark d-flex align-items-center">
                            <div class="circle-icon-xs bg-danger bg-opacity-10 me-2">
                                <i class="bi bi-cash-coin text-danger"></i>
                            </div>
                            Sistem Pembayaran
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('peminjaman.calendar') }}" class="text-decoration-none text-dark d-flex align-items-center">
                            <div class="circle-icon-xs bg-info bg-opacity-10 me-2">
                                <i class="bi bi-calendar-week text-info"></i>
                            </div>
                            Kalender
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark d-flex align-items-center">
                            <div class="circle-icon-xs bg-primary bg-opacity-10 me-2">
                                <i class="bi bi-graph-up text-primary"></i>
                            </div>
                            Dashboard & Laporan
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="circle-icon-sm bg-danger me-3">
                        <i class="bi bi-headset text-white"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Kontak & Bantuan</h5>
                </div>
                <ul class="list-unstyled text-dark">
                    <li class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="circle-icon-xs bg-success bg-opacity-10 me-2 mt-1">
                                <i class="bi bi-geo-alt text-success"></i>
                            </div>
                            <div>
                                <small>Alamat</small>
                                <div>Desa Makmur, Kec. Sejahtera</div>
                            </div>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="circle-icon-xs bg-primary bg-opacity-10 me-2 mt-1">
                                <i class="bi bi-telephone text-primary"></i>
                            </div>
                            <div>
                                <small>Telepon</small>
                                <div>(021) 1234-5678</div>
                            </div>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="circle-icon-xs bg-warning bg-opacity-10 me-2 mt-1">
                                <i class="bi bi-envelope text-warning"></i>
                            </div>
                            <div>
                                <small>Email</small>
                                <div>
                                    <a href="mailto:admin@fasilitasdesa.test" class="text-dark text-decoration-none">
                                        admin@fasilitasdesa.test
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-start">
                            <div class="circle-icon-xs bg-info bg-opacity-10 me-2 mt-1">
                                <i class="bi bi-clock text-info"></i>
                            </div>
                            <div>
                                <small>Jam Operasional</small>
                                <div>Senin - Jumat: 08:00 - 17:00</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end row -->

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="footer-alt text-center">
                    <hr class="my-4">

                    <!-- Quick Links dengan Ikon Bulat -->
                    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                        <a href="{{ route('about') }}" class="text-decoration-none text-dark d-flex align-items-center" title="Tentang Aplikasi">
                            <div class="circle-icon-xs bg-info bg-opacity-10 me-2">
                                <i class="bi bi-info-circle text-info"></i>
                            </div>
                            Tentang
                        </a>

                        <a href="#" class="text-decoration-none text-dark d-flex align-items-center" title="Kebijakan Privasi">
                            <div class="circle-icon-xs bg-success bg-opacity-10 me-2">
                                <i class="bi bi-shield-check text-success"></i>
                            </div>
                            Privacy Policy
                        </a>

                        <a href="#" class="text-decoration-none text-dark d-flex align-items-center" title="Syarat & Ketentuan">
                            <div class="circle-icon-xs bg-warning bg-opacity-10 me-2">
                                <i class="bi bi-journal-text text-warning"></i>
                            </div>
                            Terms
                        </a>

                        <a href="#" class="text-decoration-none text-dark d-flex align-items-center" title="Bantuan">
                            <div class="circle-icon-xs bg-primary bg-opacity-10 me-2">
                                <i class="bi bi-question-circle text-primary"></i>
                            </div>
                            Help
                        </a>

                        <a href="#" class="text-decoration-none text-dark d-flex align-items-center" title="FAQ">
                            <div class="circle-icon-xs bg-danger bg-opacity-10 me-2">
                                <i class="bi bi-chat-left-text text-danger"></i>
                            </div>
                            FAQ
                        </a>
                    </div>

                    <!-- Copyright -->
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <div class="circle-icon-xs bg-dark bg-opacity-10 me-2">
                            <i class="bi bi-c-circle text-dark"></i>
                        </div>
                        <p class="text-muted mb-0">
                            <script>document.write(new Date().getFullYear())</script>
                            <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark fw-bold mx-1">
                                Fasilitas Desa
                            </a>
                            - All rights reserved
                        </p>
                    </div>

                    <!-- Badge Teknologi dengan Ikon Bulat -->
                    <div class="mt-4">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <div class="circle-icon-xs bg-dark bg-opacity-10 me-2">
                                <i class="bi bi-cpu text-dark"></i>
                            </div>
                            <small class="text-muted">Dibangun dengan:</small>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-2">
                            <div class="tech-badge-circle bg-primary">
                                <i class="fab fa-laravel text-white"></i>
                                <span>Laravel</span>
                            </div>
                            <div class="tech-badge-circle bg-success">
                                <i class="fab fa-php text-white"></i>
                                <span>PHP 8</span>
                            </div>
                            <div class="tech-badge-circle bg-info">
                                <i class="fas fa-database text-white"></i>
                                <span>MySQL</span>
                            </div>
                            <div class="tech-badge-circle bg-warning">
                                <i class="fab fa-bootstrap text-white"></i>
                                <span>Bootstrap</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</footer>
<!-- END FOOTER -->

<style>
    .footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    /* Circle Icon Styles */
    .circle-icon-sm {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .circle-icon-xs {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .circle-social-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        border: 1px solid #dee2e6;
        color: #495057;
        transition: all 0.3s ease;
    }

    .circle-social-icon:hover {
        background-color: #198754;
        color: white;
        border-color: #198754;
        transform: translateY(-3px);
    }

    /* Tech Badge Circle */
    .tech-badge-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 8px;
        transition: all 0.3s ease;
    }

    .tech-badge-circle:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .tech-badge-circle i {
        font-size: 1.5rem;
        margin-bottom: 4px;
    }

    .tech-badge-circle span {
        font-size: 0.7rem;
        color: white;
        font-weight: 500;
    }

    /* Link Hover Effects */
    .footer a {
        transition: all 0.3s ease;
    }

    .footer a:hover {
        color: #198754 !important;
    }

    .footer .list-unstyled li a:hover {
        padding-left: 5px;
    }

    .footer h5 {
        font-weight: 600;
        color: #2c3e50;
    }

    .footer .list-unstyled li {
        padding: 4px 0;
    }

    .footer address div {
        font-size: 0.9rem;
    }

    .footer address small {
        font-size: 0.75rem;
        color: #6c757d;
        display: block;
        margin-bottom: 2px;
    }

    /* Background colors */
    .bg-primary { background-color: #0d6efd !important; }
    .bg-success { background-color: #198754 !important; }
    .bg-warning { background-color: #ffc107 !important; }
    .bg-danger { background-color: #dc3545 !important; }
    .bg-info { background-color: #0dcaf0 !important; }
    .bg-dark { background-color: #212529 !important; }

    /* Background opacity */
    .bg-opacity-10 {
        background-color: rgba(25, 135, 84, 0.1) !important;
    }

    .bg-primary.bg-opacity-10 {
        background-color: rgba(13, 110, 253, 0.1) !important;
    }

    .bg-success.bg-opacity-10 {
        background-color: rgba(25, 135, 84, 0.1) !important;
    }

    .bg-warning.bg-opacity-10 {
        background-color: rgba(255, 193, 7, 0.1) !important;
    }

    .bg-danger.bg-opacity-10 {
        background-color: rgba(220, 53, 69, 0.1) !important;
    }

    .bg-info.bg-opacity-10 {
        background-color: rgba(13, 202, 240, 0.1) !important;
    }

    .bg-dark.bg-opacity-10 {
        background-color: rgba(33, 37, 41, 0.1) !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .tech-badge-circle {
            width: 60px;
            height: 60px;
        }

        .tech-badge-circle i {
            font-size: 1.2rem;
        }

        .tech-badge-circle span {
            font-size: 0.6rem;
        }
    }
</style>

<!-- Add Font Awesome for tech icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
