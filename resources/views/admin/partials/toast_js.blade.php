<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "300",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    window.livewire.onError(statusCode => {
        if (statusCode === 419) {
            toastr.options = {
                "positionClass": "toast-top-center",
                "closeButton": false,
                "timeOut": "2000",
            };
            toastr.options.onHidden = function() {
                window.location.href=window.location.href;
            }
            toastr.error('Atención!, tu sesión ha expirado, redirigiendo...');
            return false;
        }
    });

    window.livewire.on('alert', param => {
        toastr[param['type']](param['message']);
    });
</script>