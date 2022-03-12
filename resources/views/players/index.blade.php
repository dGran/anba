<div>
	<div class="max-w-7xl mx-auto sm:px-3 sm:px-6 lg:px-8 my-4 md:my-8">
		@include('players.index.filters')
    	@include('players.index.data')
	</div>

	@section('js')
		<script>
		    document.addEventListener('livewire:load', function () {
		        Mousetrap.bind("right", function() {
		            @this.nextPage({{ $players->lastPage() }});
		            return false;
		        });
		        Mousetrap.bind("left", function() {
		            @this.previousPage({{ $players->lastPage() }});
		            return false;
		        });
				Mousetrap.bind(['ctrl+right', 'command+right'], function() {
				    @this.toPage({{ $players->lastPage() }});
				    return false;
				});
				Mousetrap.bind(['ctrl+left', 'command+left'], function() {
				    @this.toPage(1);
				    return false;
				});
			    Mousetrap.bind('/', function() {
			        $('.search-input').focus();
			        $('.search-input').select();
			        return false;
			    });
		    });
		</script>
	@endsection
</div>
