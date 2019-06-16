<head>
	<meta name="robots" content="noindex"> 
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="farid shahidi">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ $meta['title'] }}</title>
	<meta name="keywords" content="{{ $meta['keywords'] }}">
	<meta name="description" content="{{ $meta['description'] }}">
	
	<meta itemprop="name" content="{{ $meta['title'] }}">
	<meta itemprop="description" content="{{ $meta['description'] }}">
	<meta itemprop="image" content="{{ $meta['image'] }}">

	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:title" content="{{ $meta['title'] }}">
	<meta property="og:description" content="{{ $meta['description'] }}">
	<meta property="og:type" content="website">
	<meta property="og:locale" content="en" />
	<meta property="og:locale:alternate" content="en" />
	<meta property="og:image" content="{{ $meta['image'] }}">
	<meta property="og:site_name" content="{{ url('/') }}">

	<meta property="twitter:card" content="summary">
	<meta property="twitter:site" content="{{ url()->current() }}">
	<meta property="twitter:title" content="{{ $meta['title'] }}">
	<meta property="twitter:description" content="{{ $meta['description'] }}">
	<meta property="twitter:creator" content="farid shahidi">
	<meta property="twitter:image" content="{{ $meta['image'] }}">
	<meta property="twitter:domain" content="{{ url('/') }}">

	<link rel="canonical" href="{{ url()->current() }}">

	<!-- start::Base Styles -->
	<link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('front/css/bs-rtl-awsome-owl.css') }}">
	<link rel="stylesheet" href="{{ asset('front/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('front/css/uikit-rtl.min.css') }}">

	<script src="{{ asset('bootstrap/jquery.min.js') }}"></script>
	<script src="{{ asset('bootstrap/popper.min.js') }}"></script>
	<script src="{{ asset('bootstrap/bootstrap.min.js') }}"></script>
	<link href="{{ asset('css/custome-front.css') }}" rel="stylesheet" />
	<!--end::Base Styles -->
	<!-- 'upload/images/favicon.png' -->
	<link rel="shortcut icon" href="{{ asset(config('0-general.favicon')) }}" />

	<script src="{{ asset('front/js/uikit.min.js') }}"></script>
	@stack('style')
</head>