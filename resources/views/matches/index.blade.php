<div>
	<!-- Page Heading -->
	@include('matches.header')

	<!-- Page Content -->
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-10">
		{{-- <p class="opacity-0 py-5" wire:loading.class="opacity-100">loading...</p> --}}

		@if (isset($regs))
			@if ($regs->count() > 0)
				@foreach ($regs as $key => $reg)
					@include('matches.item')
				@endforeach
				@if ($regs->total() > $perPage)
					<div class="pagination-wrapper">
						{{ $regs->links('vendor.pagination.tailwind') }}
					</div>
				@endif
			@else
				<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 w-full py-4 px-3 ">
					No existen partidos
				</div>
			@endif
		@else
			<div class="bg-white dark:bg-gray-750 shadow-md rounded mx-3 md:mx-0 w-full">
				No existen temporadas configuradas
			</div>
		@endif
	</div>
</div>