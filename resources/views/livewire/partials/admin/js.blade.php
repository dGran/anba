<script>
    Mousetrap.bind('/', function() {
        $('.search-input').focus();
        $('.search-input').select();
        return false;
    });

    document.addEventListener('livewire:load', function () {
        Mousetrap.bind("right", function() {
            @this.nextPage();
            return false;
        });
        Mousetrap.bind("left", function() {
            @this.previousPage();
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