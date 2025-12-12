{{-- resources/views/layouts/guest/css.blade.php --}}

<!-- favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

<!-- css -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Color style -->
<link href="{{ asset('assets/css/colors/default.css') }}" rel="stylesheet" />

<!-- Font Awesome untuk WhatsApp icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- WhatsApp Button CSS -->
<style>
    /* WhatsApp Floating Button */
    .whatsapp-float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 90px; /* Jarak dari back-to-top button */
        right: 30px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50%;
        text-align: center;
        font-size: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1030; /* Lebih tinggi dari back-to-top (biasanya 1020) */
        display: none; /* Awalnya disembunyikan */
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
        border: 2px solid white;
        opacity: 0; /* Untuk animasi */
    }

    .whatsapp-float:hover {
        background-color: #128C7E;
        color: #FFF;
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    .whatsapp-float i {
        margin-top: 4px;
    }

    /* WhatsApp Tooltip */
    .whatsapp-tooltip {
        position: fixed;
        bottom: 90px;
        right: 100px;
        background-color: #333;
        color: white;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 14px;
        opacity: 0;
        transform: translateX(20px);
        transition: all 0.3s ease;
        pointer-events: none;
        z-index: 1029;
        white-space: nowrap;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .whatsapp-tooltip::after {
        content: '';
        position: absolute;
        top: 50%;
        right: -6px;
        transform: translateY(-50%);
        border-width: 6px 0 6px 6px;
        border-style: solid;
        border-color: transparent transparent transparent #333;
    }

    .whatsapp-float:hover + .whatsapp-tooltip {
        opacity: 1;
        transform: translateX(0);
    }

    /* Responsive untuk desktop */
    @media (min-width: 992px) {
        .whatsapp-float {
            bottom: 100px;
        }
        .whatsapp-tooltip {
            bottom: 100px;
        }
    }

    /* Responsive untuk tablet */
    @media (max-width: 991.98px) {
        .whatsapp-float {
            bottom: 85px;
            right: 25px;
        }
        .whatsapp-tooltip {
            bottom: 85px;
            right: 95px;
        }
    }

    /* Responsive untuk mobile */
    @media (max-width: 768px) {
        .whatsapp-float {
            width: 50px;
            height: 50px;
            bottom: 80px;
            right: 20px;
            font-size: 25px;
        }

        .whatsapp-tooltip {
            bottom: 80px;
            right: 80px;
            font-size: 12px;
            padding: 6px 10px;
        }
    }

    /* Untuk layar kecil (mobile) */
    @media (max-width: 576px) {
        .whatsapp-float {
            width: 45px;
            height: 45px;
            bottom: 75px;
            right: 15px;
            font-size: 22px;
        }

        .whatsapp-tooltip {
            bottom: 75px;
            right: 70px;
            font-size: 11px;
            padding: 5px 8px;
        }
    }

    /* Untuk layar sangat kecil */
    @media (max-width: 375px) {
        .whatsapp-float {
            bottom: 70px;
            right: 10px;
        }

        .whatsapp-tooltip {
            bottom: 70px;
            right: 65px;
        }
    }
</style>

<!-- Card View CSS untuk Peminjaman -->
<style>
    /* Card Hover Effect */
    .hover-card {
        transition: all 0.3s ease;
        border-radius: 12px;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }

    /* Avatar untuk peminjam */
    .avatar-circle-sm {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
        color: white;
    }

    /* Text truncate untuk 2 baris */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
    }

    /* Status Colors untuk badges */
    .bg-pending {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    .bg-approved {
        background-color: #28a745 !important;
        color: #fff !important;
    }

    .bg-rejected {
        background-color: #dc3545 !important;
        color: #fff !important;
    }

    .bg-completed {
        background-color: #17a2b8 !important;
        color: #fff !important;
    }

    .bg-cancelled {
        background-color: #6c757d !important;
        color: #fff !important;
    }

    /* Badge styling */
    .badge {
        font-size: 0.8em;
        font-weight: 500;
        padding: 0.5em 1em;
    }

    /* Dropdown menu styling */
    .dropdown-menu {
        min-width: 180px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    /* Button styling */
    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border-radius: 6px;
    }

    /* Card body padding untuk mobile */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem !important;
        }

        .badge {
            font-size: 0.75em !important;
            padding: 0.4em 0.8em;
        }

        .avatar-circle-sm {
            width: 35px;
            height: 35px;
            font-size: 12px;
        }
    }

    /* Pagination styling */
    .page-link {
        border-radius: 6px;
        margin: 0 2px;
        border: 1px solid #dee2e6;
        color: #25d366;
    }

    .page-item.active .page-link {
        background-color: #25d366;
        border-color: #25d366;
        color: white;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
    }

    /* Form select styling untuk filter */
    .form-select {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: #25d366;
        box-shadow: 0 0 0 0.25rem rgba(37, 211, 102, 0.25);
    }

    /* Input group styling */
    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #6c757d;
    }

    /* Empty state styling */
    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
    }

    .empty-state i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 1rem;
    }

    /* Card border colors */
    .border-start.border-warning {
        border-left-color: #ffc107 !important;
    }

    .border-start.border-success {
        border-left-color: #28a745 !important;
    }

    .border-start.border-danger {
        border-left-color: #dc3545 !important;
    }

    .border-start.border-info {
        border-left-color: #17a2b8 !important;
    }

    .border-start.border-secondary {
        border-left-color: #6c757d !important;
    }

    .border-start.border-primary {
        border-left-color: #0d6efd !important;
    }

    /* Responsive grid untuk cards */
    @media (max-width: 576px) {
        .col-md-6.col-xl-4 {
            margin-bottom: 1rem;
        }
    }
</style>
