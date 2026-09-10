<meta charset="utf-8">
<meta name="keywords" content="ShopUS, bootstrap-5, bootstrap, sass, css, HTML Template, HTML,html, bootstrap template, free template, figma, web design, web development,front end, bootstrap datepicker, bootstrap timepicker, javascript, ecommerce template">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ $setting->meta_desc }}">
<link rel="icon" href="{{ $setting->favicon }}">

<title>{{ $setting->site_name }}: @yield('title')</title>

<link rel="stylesheet" href="{{ asset('asset/website') }}/css/swiper10-bundle.min.css">

<link rel="stylesheet" href="{{ asset('asset/website') }}/css/bootstrap-5.3.2.min.css">

<link rel="stylesheet" href="{{ asset('asset/website') }}/css/nouislider.min.css">

<link rel="stylesheet" href="{{ asset('asset/website') }}/css/aos-3.0.0.css">

<link rel="stylesheet" href="{{ asset('asset/website') }}/css/style.css">
@stack('css')
