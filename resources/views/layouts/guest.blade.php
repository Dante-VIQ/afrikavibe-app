<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="Africa travel, African culture, African destinations, Explore Africa, travel blog, African art, African history, African cuisine.">
<meta name="google-adsense-account" content="ca-pub-1920954764751411">
    <meta name="description"
        content="Discover the rich tapestry of Africa's diverse cultures, breathtaking landscapes, and unique experiences. Explore top travel destinations, art, history, and cuisine on AfrikaVibe.">

        <meta name="google-adsense-account" content="ca-pub-1920954764751411">
    <!-- Logo and App Name at the top of the head visually -->
    <link rel="icon" href="{{ asset('img/logo1.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('img/logo1.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/logo1.png') }}" type="image/png">
    <title>{{ config('app.name', '  Vumbi - Discover Africa') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet"> --}}

    <!-- Inline CSS for masking -->
    {{-- <style>
        .splash-mask .splash-image {
            width: 100%;
            height: 100%;
            background-image: url('{{ $photo }}');
            background-size: cover;
            background-position: center;

            -webkit-mask-image: url('{{ $mask }}');
            -webkit-mask-repeat: no-repeat;
            -webkit-mask-size: cover;
            -webkit-mask-position: center;

            mask-image: url('{{ $mask }}');
            mask-repeat: no-repeat;
            mask-size: cover;
            mask-position: center;
        }
    </style> --}}
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TJQZ8G6KGS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-TJQZ8G6KGS');
</script>

    <!-- Vite Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="font-serif">

    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @auth
        @include('livewire.layout.navigation')
        @else
        @include('livewire.welcome.navigation')
        @endauth

        <!-- Page Content -->
        <main>
            {{ $slot }}
            {{-- @livewire('spa-container') --}}
        </main>


        <!-- Footer Start -->
        <div>
<livewire:footer-card />
        <!-- Footer End -->

    </div>
    @livewire('comment-modal')

    @livewireScripts
    {{-- <x-skeleton-loader /> --}}
    <script src="https://www.dwin2.com/pub.2580697.min.js"></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1920954764751411"
     crossorigin="anonymous"></script>
<!-- Cutlery -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1920954764751411"
     data-ad-slot="3863684113"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <script type="module" src="{{ asset('/js/main.js') }}" defer></script>

    @stack('modals')

</body>

</html>
