<head>
    @if(!$meta['google_index'])
        <meta name="robots" content="noindex">
    @endif
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="farid.sh69@gmail.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! $meta['title'] !!}  &bull; MeneW</title>
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

    <link rel="canonical" href="{{ $meta['canonical_url'] }}">
    <link rel="shortcut icon" href="{{ asset($shop->favicon) }}" />

    <!--begin::Base Styles -->
    <link href="{{ asset('css/front/shops/main/swiper.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/front/shops/main/smooth-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/front/shops/main/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/front/shops/main/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/front/shops/main/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/front/shops/denja/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/front/shops/main/fontawesome.css') }}" rel="stylesheet" />
    <!--end::Base Styles -->

</head>


    <!-- <meta name="application-name" content="MeneW" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/menew_icon-removebg-preview.png?v=2') }}" />
    <link rel="shortcut icon" sizes="196x196" href="{{ asset('images/menew_icon-removebg-preview.png?v=2') }}" />
    <link rel="shortcut icon" sizes="128x128" href="{{ asset('images/menew_icon-removebg-preview.png?v=2') }}" />
    <link rel="icon" href="{{ asset('images/menew_icon-removebg-preview.png?v=2') }}" type="{{ asset('images/menew_icon-removebg-preview.png?v=2') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/menew_icon-removebg-preview.png?v=2') }}" /> -->

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, height=device-height, viewport-fit=cover"> -->

