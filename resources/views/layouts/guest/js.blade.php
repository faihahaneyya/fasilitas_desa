{{-- resources/views/layouts/guest/js.blade.php --}}

<!-- javascript -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- Main Js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Back to top Script -->
<script>
    // Back to top
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    // Show/hide back to top button
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        var mybutton = document.getElementById("back-to-top");
        if (mybutton) {
            if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
    }
</script>

<!-- WhatsApp Button JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // WhatsApp Button Functionality
        const whatsappBtn = document.querySelector('.whatsapp-float');

        if (whatsappBtn) {
            // Tampilkan button dengan animasi setelah halaman load
            setTimeout(() => {
                whatsappBtn.style.opacity = '0';
                whatsappBtn.style.display = 'flex';
                setTimeout(() => {
                    whatsappBtn.style.opacity = '1';
                    whatsappBtn.style.transition = 'opacity 0.5s ease';
                }, 10);
            }, 800);

            // Sembunyikan tooltip saat scroll
            window.addEventListener('scroll', function() {
                const tooltip = document.querySelector('.whatsapp-tooltip');
                if (tooltip) {
                    tooltip.style.opacity = '0';
                }
            });

            // URL WhatsApp tetap sederhana tanpa pesan
            const defaultNumber = '6281234567890'; // GANTI DENGAN NOMOR ANDA
            whatsappBtn.href = `https://wa.me/${defaultNumber}`;
        }
    });
</script>{{-- resources/views/layouts/guest/js.blade.php --}}
