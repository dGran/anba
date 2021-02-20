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

    window.livewire.on('openAddModal', () => {
        $('.modal').modal('hide');
        $('#addModal').modal('show');
        $('.inputFile').val(null);
    });
    window.livewire.on('closeAddModal', () => {
        $('#addModal').modal('hide');
    });

    window.livewire.on('openEditModal', () => {
        $('.modal').modal('hide');
        // $('#viewModal').modal('hide');
        $('#editModal').modal('show');
        $('.inputFile').val(null);
    });
    window.livewire.on('closeEditModal', () => {
        $('#editModal').modal('hide');
    });

    window.livewire.on('openDestroyModal', () => {
        $('.modal').modal('hide');
        $('#destroyModal').modal('show');
    });
    window.livewire.on('closeDestroyModal', () => {
        $('#destroyModal').modal('hide');
    });

    window.livewire.on('openViewModal', () => {
        $('.modal').modal('hide');
        $('#viewModal').modal('show');
    });

    window.livewire.on('openDuplicateModal', () => {
        $('.modal').modal('hide');
        $('#duplicateModal').modal('show');
    });
    window.livewire.on('closeDuplicateModal', () => {
        $('#duplicateModal').modal('hide');
    });

    window.livewire.on('openImportModal', () => {
        $('.modal').modal('hide');
        $('#importModal').modal('show');
        $('.fileImport').val(null);
    });
    window.livewire.on('closeImportModal', () => {
        $('#importModal').modal('hide');
    });

    window.livewire.on('openExportTableModal', () => {
        $('.modal').modal('hide');
        $('#exportTableModal').modal('show');
    });
    window.livewire.on('closeExportTableModal', () => {
        $('#exportTableModal').modal('hide');
    });

    window.livewire.on('openExportSelectedModal', () => {
        $('.modal').modal('hide');
        $('#exportSelectedModal').modal('show');
    });
    window.livewire.on('closeExportSelectedModal', () => {
        $('#exportSelectedModal').modal('hide');
    });

    window.livewire.on('openSelectedModal', () => {
        $('.modal').modal('hide');
        $('#selectedModal').modal('show');
    });
    window.livewire.on('closeSelectedModal', () => {
        $('#selectedModal').modal('hide');
    });

    window.livewire.on('openFiltersModal', () => {
        $('.modal').modal('hide');
        $('#filtersModal').modal('show');
    });
    window.livewire.on('closeFiltersModal', () => {
        $('#filtersModal').modal('hide');
    });

    Mousetrap.bind('/', function() {
        $('.search-input').focus();
        $('.search-input').select();
        return false;
    });

    Mousetrap.bind(['shift+l', 'shift+l'], function() {
        $('#left-sidebar').trigger('click');
        return false;
    });

    Mousetrap.bind(['shift+r', 'shift+r'], function() {
        $('#right-sidebar').trigger('click');
        return false;
    });


    document.addEventListener('livewire:load', function () {
        Mousetrap.bind("right", function() {
            @this.setNextPage();
            return false;
        });
        Mousetrap.bind("left", function() {
            @this.setPreviousPage();
            return false;
        });
        Mousetrap.bind(['command+shift+a', 'ctrl+shift+a'], function() {
            @this.add();
            return false;
        });
        Mousetrap.bind(['command+shift+d', 'ctrl+shift+d'], function() {
            @this.confirmDestroy();
            return false;
        });
        Mousetrap.bind(['command+shift+s', 'ctrl+shift+s'], function() {
            @this.viewSelected(true);
        });
        Mousetrap.bind(['command+shift+f', 'ctrl+shift+f'], function() {
            @this.viewFilters(true);
        });
        Mousetrap.bind('c s', function() {
            @this.cancelSelection();
        });
        Mousetrap.bind('c f', function() {
            @this.clearAllFilters();
        });
        Mousetrap.bind('p 1', function() {
            @this.setFilterPerPage("5");
        });
        Mousetrap.bind('p 2', function() {
            @this.setFilterPerPage("10");
        });
        Mousetrap.bind('p 3', function() {
            @this.setFilterPerPage("15");
        });
        Mousetrap.bind(['p q', 'p 4'], function() {
            @this.setFilterPerPage("25");
        });
        Mousetrap.bind('p 5', function() {
            @this.setFilterPerPage("50");
        });
        Mousetrap.bind('p 6', function() {
            @this.setFilterPerPage("100");
        });

        $(".search-input").keydown(function(event) {
            if (event.key == "Escape") {
               @this.cancelFilterSearch();
            }
        });

        $(".modal").keydown(function(event) {
            if (event.key == "Escape") {
               $(".modal").modal('hide');
            }
        });
        $('.modal').on('hide.bs.modal', function() {
            @this.closeAnyModal();
        });
    });

    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });
    if ("{{ $firstRenderSaved }}" && "{{ $currentModal }}") {
        $('#{{ $currentModal }}').modal('show');
    }

    // fix padding-right on open modal
    // $('.modal').on('show.bs.modal', function (e) {
    //     $('body').addClass('test');
    // });
</script>