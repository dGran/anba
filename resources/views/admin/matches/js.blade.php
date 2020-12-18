<script>
    window.livewire.on('openBoxscoreModal', () => {
        $('.modal').modal('hide');
        $('#boxscoreModal').modal('show');
    });
    window.livewire.on('closeBoxscoreModal', () => {
        $('#boxscoreModal').modal('hide');
    });

    // $("numericInput").keydown(function(){
    //    if ($(this).val() === null) {
    //        $(this).val(0);
    //    }
    // });

</script>