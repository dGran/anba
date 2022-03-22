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

// Livewire 419
window.livewire.onError(statusCode => {
    if (statusCode === 419) {
        toastr.options = {
            "positionClass": "toast-top-center",
            "closeButton": false,
            "timeOut": "1000",
        };
        toastr.options.onHidden = function() {
            window.location.href=window.location.href;
        }
        toastr.info('Recargando página por inactividad');
        return false;
    }
});
// END: Livewire 419