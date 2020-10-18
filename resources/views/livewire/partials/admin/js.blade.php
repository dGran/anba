<script>
    Mousetrap.bind('/', function() {
        $('.search-input').focus();
        $('.search-input').select();
        return false;
    });

    document.addEventListener('livewire:load', function () {
        Mousetrap.bind('esc', function() {
            @this.cancelSelection();
        });
        Mousetrap.bind("right", function() {
            @this.nextPage();
        });
        Mousetrap.bind("left", function() {
            @this.previousPage();
        });
        Mousetrap.bind(['command+shift+a', 'ctrl+shift+a'], function() {
            @this.add();
        });
    });
</script>