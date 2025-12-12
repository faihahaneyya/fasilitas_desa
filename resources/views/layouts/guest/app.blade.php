<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Fasilitas Desa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Responsive bootstrap landing template" />
    <meta name="author" content="Techzaa" />

    @include('layouts.guest.css')
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="72">
    @include('layouts.guest.header')

    @yield('content')

    @include('layouts.guest.footer')

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top-btn text-white px-1 rounded"><i
            class="pe-7s-angle-up"></i></a>

    <!-- WhatsApp Button -->
    @php
        // Konfigurasi WhatsApp - GANTI DENGAN NOMOR ANDA
        $whatsappNumber = '081380920101'; // Format: 628xxxxxxxxxx
        $whatsappUrl = "https://wa.me/{$whatsappNumber}"; // TANPA PESAN DEFAULT
        $tooltipText = 'Butuh Bantuan? Chat Kami!';
    @endphp

    <a href="{{ $whatsappUrl }}"
       class="whatsapp-float"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Hubungi via WhatsApp"
       title="{{ $tooltipText }}">
        <i class="fab fa-whatsapp"></i>
    </a>
    <div class="whatsapp-tooltip">{{ $tooltipText }}</div>

    @include('layouts.guest.js')
</body>

</html>
