<div>
	<!-- Page Heading -->
	@include('matches.header')

	<!-- Page Content -->
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
		@if (isset($regs))
			@if ($regs->count() > 0)
				@foreach ($regs as $key => $reg)
					@include('matches.item')
				@endforeach
			@else
				<div class="py-3">
					No existen partidos
				</div>
			@endif
		@else
			<div class="py-3">
				No existen temporadas configuradas
			</div>
		@endif
	</div>
</div>