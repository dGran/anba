<script>
    window.livewire.on('openBoxscoreModal', () => {
        $('.modal').modal('hide');
        $('#boxscoreModal').modal('show');
    });
    window.livewire.on('closeBoxscoreModal', () => {
        $('#boxscoreModal').modal('hide');
    });

    window.livewire.on('openResetMatchModal', () => {
        $('.modal').modal('hide');
        $('#resetMatchModal').modal('show');
    });
    window.livewire.on('closeResetMatchModal', () => {
        $('#resetMatchModal').modal('hide');
    });

    window.livewire.on('openResetScoreModal', () => {
        $('.modal').modal('hide');
        $('#resetScoreModal').modal('show');
    });
    window.livewire.on('closeResetScoreModal', () => {
        $('#resetScoreModal').modal('hide');
    });

    // $("numericInput").keydown(function(){
    //    if ($(this).val() === null) {
    //        $(this).val(0);
    //    }
    // });

</script>