<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Admin ANBA</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

	    <style>
			.left_area h3{
				color: #fff;
				margin: 0;
				text-transform: uppercase;
				font-size: 22px;
				font-weight: 900;
			}

			.left_area span{
				color: #E13C46;
			}

			.profile_info{
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
			}

			label #sidebar_btn{
				z-index: 1;
				/*color: #fff;*/
				/*position: fixed;*/
				cursor: pointer;
/*				left: 300px;
				font-size: 20px;
				margin: 5px 0;*/
				transition: 0.5s;
				transition-property: color;
			}

			label #sidebar_btn:hover{
				/*color: #19B3D3;*/
			}

			#check:checked ~ .sidebar{
				left: -185px;
			}

			#check:checked ~ .sidebar a span{
				display: none;
			}

			#check:checked ~ .sidebar a{
				font-size: 20px;
				margin-left: 185px;
				width: 100%;
			}

			.content{
				/*width: (100% - 250px);*/
				/*margin-top: 40px;*/
				padding-top: 40px;
				margin-left: 2em;
				background: url(background.png) no-repeat;
				background-position: center;
				background-size: cover;
				height: 100vh;
				transition: 0.5s;
			}

			#check:checked ~ .content{
				margin-left: 80px;
			}

			#check:checked ~ .sidebar .profile_info{
				display: none;
			}

			#check{
				display: none;
			}

			.mobile_nav{
				display: none;
			}

			.content .card p{
				background: #fff;
				padding: 15px;
				margin-bottom: 10px;
				font-size: 14px;
				opacity: 0.8;
			}

			/* Responsive CSS */

			@media screen and (max-width: 780px) {
				.sidebar{
					display: none;
				}

				#sidebar_btn{
					display: none;
				}

				.content{
					margin-left: 0;
					margin-top: 0;
					padding: 10px 20px;
					transition: 0s;
				}

				#check:checked ~ .content{
					margin-left: 0;
				}

				.mobile_nav{
					display: block;
					width: calc(100% - 0%);
				}

				.nav_bar{
					background: #222;
					width: (100% - 0px);
					margin-top: 70px;
					display: flex;
					justify-content: space-between;
					align-items: center;
					padding: 10px 20px;
				}

				.nav_bar .mobile_profile_image{
					width: 50px;
					height: 50px;
					border-radius: 50%;
				}

				.nav_bar .nav_btn{
					color: #fff;
					font-size: 22px;
					cursor: pointer;
					transition: 0.5s;
					transition-property: color;
				}

				.nav_bar .nav_btn:hover{
					color: #19B3D3;
				}

				.mobile_nav_items{
					background: #2F323A;
					display: none;
				}

				.mobile_nav_items a{
					color: #fff;
					display: block;
					text-align: center;
					letter-spacing: 1px;
					line-height: 60px;
					text-decoration: none;
					box-sizing: border-box;
					transition: 0.5s;
					transition-property: background;
				}

				.mobile_nav_items a:hover{
					background: #19B3D3;
				}

				.mobile_nav_items i{
					padding-right: 10px;
				}

				.active{
					display: block;
				}
			}
		</style>

        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        {{-- animate.css --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
        {{-- JQuery --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        {{-- Mouse Trap --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.3/mousetrap.min.js"></script>
        {{-- Tail Select --}}
        <script src="https://cdn.jsdelivr.net/npm/tail.select@latest/"></script>
	</head>

	<body>
		<input type="checkbox" id="check">
		<!--header area start-->
		<header class="px-6 fixed top-0 bg-white w-full text-gray-500" style="z-index: 1; border-bottom: 1px solid #dee2e6">
			<div class="md:ml-64 flex items-center h-14">

				<label for="check">
					<i class="fas fa-bars" id="sidebar_btn"></i>
				</label>
				<div class="flex-auto">
					<h3 class="ml-8">Admin <span>ANBA</span></h3>
				</div>
				<div class="border">
					<a href="{{ route('dashboard') }}" class="">Salir de admin</a>
				</div>
			</div>
		</header>
		<!--header area end-->

		<!--mobile navigation bar start-->
		<div class="mobile_nav" class="bg-pink-800">
			<div class="nav_bar">
				<img src="1.png" class="mobile_profile_image" alt="">
				<i class="fa fa-bars nav_btn"></i>
			</div>
			<div class="mobile_nav_items">
				<a href="#"><i class="fas fa-desktop"></i><span>option 1</span></a>
				<a href="#"><i class="fas fa-cogs"></i><span>option 2</span></a>
				<a href="#"><i class="fas fa-table"></i><span>option 3</span></a>
				<a href="#"><i class="fas fa-th"></i><span>option 4</span></a>
				<a href="#"><i class="fas fa-info-circle"></i><span>option 5</span></a>
				<a href="#"><i class="fas fa-sliders-h"></i><span>option 6</span></a>
			</div>
		</div>
		<!--mobile navigation bar end-->

		<!--sidebar start-->
		<div class="sidebar w-64 hidden md:block fixed top-0 left-0 h-screen flex flex-col" style="z-index: 1; background: #343a40; transition: 0.5s; transition-property: left; overflow-y: auto; box-shadow: 0 14px 28px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.22)!important;">
			<a href="#" class="flex items-center px-4 h-14 border-b border-gray-600">
				<figure class="h-9 w-9">
					<img src="{{ asset('img/logo.png') }}" alt="Admin Logo" class="rounded-full object-cover opacity-75">
				</figure>
				<span class="flex-auto brand-text font-light text-gray-300 text-xl ml-2">Admin ANBA</span>
				<span class="text-xxs px-2 py-1 bg-teal-500 rounded-md text-white text-right">beta v 0.15</span>
			</a>
			<a href="{{ asset('user/profile') }}" class="group flex items-center px-4 py-3 border-b border-gray-600 text-gray-300 hover:text-white">
				<figure class="h-9 w-9">
					<img src="{{ asset(auth()->user()->profile_photo_url) }}" alt="Avatar" class="rounded-full object-cover opacity-75 filter-grayscale group-hover:filter-none" style="box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23)!important;">
				</figure>
				<span class="font-medium ml-2">
					{{ auth()->user()->name }}
				</span>
			</a>
			<ul class="py-4">
				<li class="mb-1">
					<a href="{{ route('admin') }}" class="flex items-center mx-2 px-4 py-2 hover:bg-gray-600 text-gray-300 hover:text-white rounded
					{{ (\Route::current()->getName() == 'admin') ? 'bg-gray-100 text-gray-800 pointer-events-none' : 'hover:bg-gray-600 hover:text-white' }}">
						<i class="fas fa-desktop text-xl w-10 text-center pr-1 -ml-2"></i>
						<span class="flex-auto">Dashboard</span>
						{{-- <span class="text-xxs px-2 py-1 bg-green-500 rounded-md text-white text-right">New</span> --}}
						{{-- <i class="fas fa-angle-left "></i> --}}
					</a>
				</li>
				<li class="mb-1">
					<a href="#" class="flex items-center mx-2 px-4 py-2 hover:bg-gray-600 text-gray-300 hover:text-white rounded">
						<i class="far fa-comment-dots text-xl w-10 text-center pr-1 -ml-2"></i>
						<span class="flex-auto">Log</span>
						{{-- <span class="text-xxs px-2 py-1 bg-green-500 rounded-md text-white text-right">New</span> --}}
						<span class="text-xs h-6 w-6 bg-red-500 rounded-full text-white text-center leading-6">18</span>
						{{-- <i class="fas fa-angle-left ml-2"></i> --}}
					</a>
				</li>

				<li class="mt-4">
					<p class="uppercase mx-2 px-2 py-2 text-gray-400 text-sm">
						Competición
					</p>
				</li>
				<li class="mb-1">
					<a href="#" class="flex items-center mx-2 px-4 py-2 hover:bg-gray-600 text-gray-300 hover:text-white rounded">
						<i class="fas fa-table text-xl w-10 text-center pr-1 -ml-2"></i>
						<span class="flex-auto">Conferencias</span>
						{{-- <span class="text-xxs px-2 py-1 bg-green-500 rounded-md text-white text-right">New</span> --}}
						{{-- <i class="fas fa-angle-left "></i> --}}
					</a>
				</li>

				<li class="mb-1">
					<a href="#" class="flex items-center mx-2 px-4 py-2 hover:bg-gray-600 text-gray-300 hover:text-white rounded">
						<i class="fas fa-table text-xl w-10 text-center pr-1 -ml-2"></i>
						<span class="flex-auto">Divisiones</span>
						{{-- <span class="text-xxs px-2 py-1 bg-green-500 rounded-md text-white text-right">New</span> --}}
						{{-- <i class="fas fa-angle-left "></i> --}}
					</a>
				</li>

				<li class="mb-1">
					<a href="#" class="flex items-center mx-2 px-4 py-2 hover:bg-gray-600 text-gray-300 hover:text-white rounded">
						<i class="fas fa-table text-xl w-10 text-center pr-1 -ml-2"></i>
						<span class="flex-auto">Temporadas</span>
						{{-- <span class="text-xxs px-2 py-1 bg-green-500 rounded-md text-white text-right">New</span> --}}
						<i class="fas fa-angle-left "></i>
					</a>
				</li>
				<li class="mt-4">
					<p class="uppercase mx-2 px-2 py-2 text-gray-400 text-sm">
						Tablas generales
					</p>
				</li>
				<li class="mb-1">
					<a href="{{ route('admin.users') }}" class="flex items-center mx-2 px-4 py-2 hover:bg-gray-600 text-gray-300 hover:text-white rounded
					{{ (\Route::current()->getName() == 'admin.users') ? 'bg-gray-100 text-gray-800 pointer-events-none' : 'hover:bg-gray-600 hover:text-white' }}">
						<i class="fas fa-table text-xl w-10 text-center pr-1 -ml-2"></i>
						<span class="flex-auto">Usuarios</span>
						{{-- <span class="text-xxs px-2 py-1 bg-green-500 rounded-md text-white text-right">New</span> --}}
						{{-- <i class="fas fa-angle-left "></i> --}}
					</a>
				</li>
				<li class="mb-1">
					<a href="#" class="flex items-center mx-2 px-4 py-2 hover:bg-gray-600 text-gray-300 hover:text-white rounded">
						<i class="fas fa-table text-xl w-10 text-center pr-1 -ml-2"></i>
						<span class="flex-auto">Equipos</span>
						{{-- <span class="text-xxs px-2 py-1 bg-green-500 rounded-md text-white text-right">New</span> --}}
						{{-- <i class="fas fa-angle-left "></i> --}}
					</a>
				</li>
				<li class="mb-1">
					<a href="#" class="flex items-center mx-2 px-4 py-2 hover:bg-gray-600 text-gray-300 hover:text-white rounded">
						<i class="fas fa-table text-xl w-10 text-center pr-1 -ml-2"></i>
						<span class="flex-auto">Jugadores</span>
						{{-- <span class="text-xxs px-2 py-1 bg-green-500 rounded-md text-white text-right">New</span> --}}
						{{-- <i class="fas fa-angle-left "></i> --}}
					</a>
				</li>
			</ul>
		</div>
		<!--sidebar end-->

		<div class="content bg-gray-50 md:ml-64 px-3 md:px-6">
			{{ $slot }}
		</div>

	    @stack('modals')

	    @livewireScripts

	    <script type="text/javascript">
	    	$(document).ready(function(){
	    		$('.nav_btn').click(function(){
	    			$('.mobile_nav_items').toggleClass('active');
	    		});
	    	});
	    </script>

	</body>
</html>