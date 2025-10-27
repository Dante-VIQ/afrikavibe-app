<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="google-adsense-account" content="ca-pub-1920954764751411">
    <meta name="keywords"
        content="Africa travel, African culture, African destinations, Explore Africa, travel blog, African art, African history, African cuisine.">
    <meta name="description"
        content="Discover the rich tapestry of Africa's diverse cultures, breathtaking landscapes, and unique experiences. Explore top travel destinations, art, history, and cuisine on AfrikaVibe.">
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
    {{-- <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'body': ['Open Sans', 'sans-serif'],
                        'heading': ['Roboto', 'sans-serif'],
                    }
                }
            }
        }
    </script> --}}

    <script data-noptimize="1" data-cfasync="false" data-wpfc-render="false">
  (function () {
      var script = document.createElement("script");
      script.async = 1;
      script.src = 'https://emrldtp.cc/NDY1NDg3.js?t=465487';
      document.head.appendChild(script);
  })();
</script>

    <!-- Vite Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="font-serif">

    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @include('livewire.layout.navigation')

        <!-- Page Content -->
        <main>
            {{ $slot }}
            {{-- @livewire('spa-container') --}}
        </main>


        <!-- Footer Start -->
        <div>
            <livewire:footer-card />
        </div>
        <!-- Footer End -->

    </div>
    @livewire('comment-modal')

    @livewireScripts
    {{-- <x-skeleton-loader /> --}}
    <script src="https://www.dwin2.com/pub.2580697.min.js"></script>
    
    <script type="module" src="{{ asset('/js/main.js') }}" defer></script>

    @stack('modals')

</body>

</html>
