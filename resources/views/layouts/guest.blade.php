<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="Africa travel, African culture, African destinations, Explore Africa, travel blog, African art, African history, African cuisine.">
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

<body class="font-body">

    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @auth
        @include('livewire.welcome.navigation')
        @else
        @include('livewire.layout.navigation')
        @endauth

        <!-- Page Content -->
        <main>
            {{ $slot }}
            {{-- @livewire('spa-container') --}}
        </main>


        <!-- Footer Start -->
        <footer class="footer">
                    <div class="sm:flex justify-content-center sm:justify-content-between">
                        <span class="text-muted text-center sm:text-left block sm:d-inline-block">Vumbi Ventures</span>
                        <span class="float-none sm:float-end d-block mt-1 sm:mt-0 text-center">Copyright © 2025. All
                            rights reserved.</span>
                    </div>
                </footer>
        <!-- Footer End -->

    </div>
    @livewire('comment-modal')

    @livewireScripts
    {{-- <x-skeleton-loader /> --}}

    <script type="module" src="{{ asset('/js/main.js') }}" defer></script>

    @stack('modals')

</body>

</html>
