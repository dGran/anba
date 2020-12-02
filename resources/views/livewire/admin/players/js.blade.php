<script>
	function set_ranges()
	{
	    $('#filterHeight').data('ionRangeSlider').update({
	        from: @this.filterHeight['from'],
	        to: @this.filterHeight['to']
	    });

	    $('#filterWeight').data('ionRangeSlider').update({
	        from: @this.filterWeight['from'],
	        to: @this.filterWeight['to']
	    });

	    $('#filterAge').data('ionRangeSlider').update({
	        from: @this.filterAge['from'],
	        to: @this.filterAge['to']
	    });

	    $('#filterYearDraft').data('ionRangeSlider').update({
	        from: @this.filterYearDraft['from'],
	        to: @this.filterYearDraft['to']
	    });
	}

    window.livewire.on('resetFiltersMode', () => {
        set_ranges();
    });

	$('#filterModal').on('show.bs.modal', function(e) {
		set_ranges();
	});

    window.livewire.on('openTransfersModal', () => {
        $('#transferModal').modal('show');
    });
    window.livewire.on('closeTransfersModal', () => {
        $('#transferModal').modal('hide');
    });

</script>