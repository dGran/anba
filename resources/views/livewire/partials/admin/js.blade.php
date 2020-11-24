<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
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

    window.livewire.on('alert', param => {
        toastr[param['type']](param['message']);
    });

    window.livewire.on('addMode', () => {
        $('#addModal').modal('show');
    });
    window.livewire.on('regStore', () => {
        $('#addModal').modal('hide');
    });

    window.livewire.on('editMode', () => {
        $('#editModal').modal('show');
    });
    window.livewire.on('regUpdate', () => {
        $('#editModal').modal('hide');
    });

    window.livewire.on('destroyMode', () => {
        $('#confirmDestroyModal').modal('show');
    });
    window.livewire.on('regDestroy', () => {
        $('#confirmDestroyModal').modal('hide');
    });

    window.livewire.on('duplicateMode', () => {
        $('#confirmDuplicateModal').modal('show');
    });
    window.livewire.on('regDuplicate', () => {
        $('#confirmDuplicateModal').modal('hide');
    });

    window.livewire.on('importMode', () => {
        $('#confirmImportModal').modal('show');
    });
    window.livewire.on('regImport', () => {
        $('#confirmImportModal').modal('hide');
    });

    window.livewire.on('exportTableMode', () => {
        $('#confirmExportTableModal').modal('show');
    });
    window.livewire.on('regExportTable', () => {
        $('#confirmExportTableModal').modal('hide');
    });

    window.livewire.on('exportSelectedMode', () => {
        $('#confirmExportSelectedModal').modal('show');
    });
    window.livewire.on('regExportSelected', () => {
        $('#confirmExportSelectedModal').modal('hide');
    });

    window.livewire.on('openSelected', () => {
        $('#selectedModal').modal('show');
    });
    window.livewire.on('closeSelected', () => {
        $('#selectedModal').modal('hide');
    });

    window.livewire.on('openFilters', () => {
        $('#filterModal').modal('show');
    });
    window.livewire.on('closeFilters', () => {
        $('#filterModal').modal('hide');
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
        Mousetrap.bind(['command+shift+o', 'ctrl+shift+o'], function() {
            @this.viewSelected(true);
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
        Mousetrap.bind(['p q', 'p 2'], function() {
            @this.setFilterPerPage("10");
        });
        Mousetrap.bind('p 3', function() {
            @this.setFilterPerPage("15");
        });
        Mousetrap.bind('p 4', function() {
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
    });
</script>