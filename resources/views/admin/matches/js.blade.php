<script>
    window.livewire.on('openBoxscoreModal', () => {
        $('.modal').modal('hide');
        $('#boxscoreModal').modal('show');
    });

    // $("numericInput").keydown(function(){
    //    if ($(this).val() === null) {
    //        $(this).val(0);
    //    }
    // });

</script>