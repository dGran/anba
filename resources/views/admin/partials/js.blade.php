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
            @this.viewFilters();
        });
        Mousetrap.bind('c s', function() {
            @this.cancelSelection();
        });
        Mousetrap.bind('c f', function() {
            @this.resetFilters();
        });
        Mousetrap.bind('p 1', function() {
            @this.setPerPage("5");
        });
        Mousetrap.bind('p 2', function() {
            @this.setPerPage("10");
        });
        Mousetrap.bind('p 3', function() {
            @this.setPerPage("15");
        });
        Mousetrap.bind(['p q', 'p 4'], function() {
            @this.setPerPage("25");
        });
        Mousetrap.bind('p 5', function() {
            @this.setPerPage("50");
        });
        Mousetrap.bind('p 6', function() {
            @this.setPerPage("100");
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

    document.addEventListener('DOMContentLoaded', function() {
        const leftSidebarButton = document.getElementById('left-sidebar');
        const rightSidebarButton = document.getElementById('right-sidebar');
        const rightAside = document.querySelector('.control-sidebar');

        function updateSidebarIcon(button, isOpenClass, openIconClass, closedIconClass) {
            const iconElement = button.querySelector('i');
            const body = document.querySelector('body');
            const isOpen = body.classList.contains(isOpenClass);

            if (isOpen) {
                iconElement.classList.remove(closedIconClass);
                iconElement.classList.add(openIconClass);
            } else {
                iconElement.classList.remove(openIconClass);
                iconElement.classList.add(closedIconClass);
            }
        }

        function setupSidebarButton(button, isOpenClass, openIconClass, closedIconClass) {
            updateSidebarIcon(button, isOpenClass, openIconClass, closedIconClass);

            button.addEventListener('click', function() {
                updateSidebarIcon(button, isOpenClass, openIconClass, closedIconClass);

                setTimeout(function() {
                    updateSidebarIcon(button, isOpenClass, openIconClass, closedIconClass);
                }, 100);
            });
        }

        setupSidebarButton(leftSidebarButton, 'sidebar-collapse', 'fa-angle-double-right', 'fa-angle-double-left');
        setupSidebarButton(rightSidebarButton, 'control-sidebar-slide-open', 'fa-angle-double-right', 'fa-angle-double-left');

        function handleClickOutsideRightSidebar(event) {
            const targetElement = event.target;
            const body = document.querySelector('body');

            if (body.classList.contains('control-sidebar-slide-open') && !rightAside.contains(targetElement) && targetElement !== rightSidebarButton && !rightSidebarButton.contains(targetElement)) {
                $('#right-sidebar').trigger('click');

                // Necesitamos actualizar el icono después de cerrar el sidebar derecho
                setTimeout(function() {
                    updateSidebarIcon(rightSidebarButton, 'control-sidebar-slide-open', 'fa-angle-double-right', 'fa-angle-double-left');
                }, 100);
            }
        }

        document.addEventListener('click', handleClickOutsideRightSidebar);

        Mousetrap.bind(['shift+l', 'shift+l'], function() {
            $('#left-sidebar').trigger('click');

            setTimeout(function() {
                updateSidebarIcon(leftSidebarButton, 'sidebar-collapse', 'fa-angle-double-right', 'fa-angle-double-left');
            }, 100);

            return false;
        });

        Mousetrap.bind(['shift+r', 'shift+r'], function() {
            $('#right-sidebar').trigger('click');

            setTimeout(function() {
                updateSidebarIcon(rightSidebarButton, 'control-sidebar-slide-open', 'fa-angle-double-right', 'fa-angle-double-left');
            }, 100);

            return false;
        });
    });


    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });

    if ("{{ $currentModal }}") {
        $('#{{ $currentModal }}').modal('show');
    }
</script>
