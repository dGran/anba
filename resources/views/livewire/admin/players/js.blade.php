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
	}

    window.livewire.on('resetFiltersMode', () => {
        set_ranges();
    });

	$('#filterModal').on('show.bs.modal', function(e) {
		set_ranges();
	});
</script>