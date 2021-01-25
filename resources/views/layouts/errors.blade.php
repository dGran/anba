<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1.0,maximum-scale=1.0,user-scalable=no,viewport-fit=cover">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="...">
		<meta name="keywords" content="...">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#00236a">
        <meta name="apple-mobile-web-app-title" content="ANBA">
        <meta name="application-name" content="ANBA">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		@yield('styles')

		<title>
			{{ env('APP_NAME') }}
			@isset($title)
			- {{ $title }}
			@endisset
		</title>
	</head>

	<body class="bg-gray-100 dark:bg-gray-750">
		@yield('content')
	</body>

</html>