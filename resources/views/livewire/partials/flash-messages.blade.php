@if (session()->has('error'))
	<div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm text-sm z-50">
		<input type="checkbox" class="hidden" id="footertoast">
		<label class="close cursor-pointer flex items-start w-full px-6 py-4 bg-red-500 rounded shadow-lg text-white" title="close" for="footertoast">
			<i class="fas fa-exclamation-triangle font-bold mt-1 mr-3"></i>
			<p>
				<span class="font-bold mr-1">Error!</span>
				{{ session('error') }}
			</p>
		</label>
	</div>
@endif

@if (session()->has('message'))
	<div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm text-sm z-50">
		<input type="checkbox" class="hidden" id="footertoast">
		<label class="close cursor-pointer flex items-start w-full px-6 py-4 bg-teal-500 rounded shadow-lg text-white" title="close" for="footertoast">
			<i class="fas fa-check font-bold mt-1 mr-3"></i>
			<p>{{ session('message') }}</p>
		</label>
	</div>
@endif

@if (session()->has('info'))
	<div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm text-sm z-50">
		<input type="checkbox" class="hidden" id="footertoast">
		<label class="close cursor-pointer flex items-start w-full px-6 py-4 bg-indigo-500 rounded shadow-lg text-white" title="close" for="footertoast">
			<i class="fas fa-info-circle font-bold mt-1 mr-3"></i>
			<p>{{ session('info') }}</p>
		</label>
	</div>
@endif