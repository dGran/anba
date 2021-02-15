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

    window.livewire.on('openCheckMatchesModal', () => {
        $('.modal').modal('hide');
        $('#checkMatchesModal').modal('show');
    });
    window.livewire.on('closeCheckMatchesModal', () => {
        $('#checkMatchesModal').modal('hide');
    });

    window.livewire.on('openImportScoresModal', () => {
        $('.modal').modal('hide');
        $('#importScoresModal').modal('show');
    });
    window.livewire.on('closeImportScoresModal', () => {
        $('#importScoresModal').modal('hide');
    });

    window.livewire.on('openImportTeamStatsModal', () => {
        $('.modal').modal('hide');
        $('#importTeamStatsModal').modal('show');
    });
    window.livewire.on('closeImportTeamStatsModal', () => {
        $('#importTeamStatsModal').modal('hide');
    });

    window.livewire.on('openImportPlayerStatsModal', () => {
        $('.modal').modal('hide');
        $('#importPlayerStatsModal').modal('show');
    });
    window.livewire.on('closeImportPlayerStatsModal', () => {
        $('#importPlayerStatsModal').modal('hide');
    });

    // $("numericInput").keydown(function(){
    //    if ($(this).val() === null) {
    //        $(this).val(0);
    //    }
    // });

</script>