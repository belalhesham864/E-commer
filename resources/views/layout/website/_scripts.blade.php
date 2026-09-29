<script src="{{ asset('asset/website') }}/assets/js/jquery_3.7.1.min.js"></script>

<script src="{{ asset('asset/website') }}/assets/js/bootstrap_5.3.2.bundle.min.js"></script>

<script src="{{ asset('asset/website') }}/assets/js/nouislider.min.js"></script>

<script src="{{ asset('asset/website') }}/assets/js/aos-3.0.0.js"></script>

<script src="{{ asset('asset/website') }}/assets/js/swiper10-bundle.min.js"></script>

<script src="{{ asset('asset/website') }}/assets/js/shopus.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('success-message', (event) => {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: event,
                showConfirmButton: true,
                timer: 2500
            });
        });

        Livewire.on('error-message', (event) => {
            Swal.fire({
                position: "top-center",
                icon: "error",
                title: event,
                showConfirmButton: true,
                timer: 2500
            });
        });
    });
</script>

@stack('js')
