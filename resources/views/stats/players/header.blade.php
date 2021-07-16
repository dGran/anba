<div class="my-2">

	{{-- work in progress --}}
	<figure class="pb-8">
		<img src="{{ asset('img/in_progress.png') }}" alt="" class="w-64 animate-pulse">
		<figcaption class="italic text-sm">
			*Tanto los datos mostrados como las opciones están en desarrollo
		</figcaption>
	</figure>
	{{--  --}}

	<h4 class="text-base font-bold uppercase tracking-wide mt-6">
		Jugadores
	</h4>

	@include('stats.players.header.basic_filters')
	@include('stats.players.header.advanced_filters')
	@include('stats.players.header.search')
	@include('stats.players.header.tags')

</div>