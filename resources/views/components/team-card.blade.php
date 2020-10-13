<a {{ $attributes->merge(['class' => 'bg-white shadow rounded p-2 m-auto px-6 hover:bg-teal-100', 'href' => '#']) }}>
	<figure>
		<img src="{{ $img }}" alt="{{ $name }}" class="p-1 bg-white h-24 w-24 oject-cover">
	</figure>
	<p class="pt-3 text-sm text-center text-gray-600">
		{{ $name }}
	</p>
{{-- 	<ul>
		@foreach ($links as $link)
			<li>
				{{ $link }}
			</li>
		@endforeach
	</ul> --}}
</a>