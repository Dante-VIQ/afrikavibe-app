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

    <link rel="icon" href="{{ asset('img/logo1.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('img/logo1.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/logo1.png') }}" type="image/png">
    <title>{{ config('app.name', 'Vumbi - Discover Africa') }}</title>

    {{-- <link rel="preload" href="{{ Vite::asset('/resources/css/app.css') }}" as="style">
        <link rel="preload" href="{{ Vite::asset('/resources/js/app.js') }}" as="script"> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> --}}

    <!-- Inline CSS for masking -->

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

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
      {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
    <!-- Vite Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="font-body">

    {{-- <x-banner /> --}}

    <div class="min-h-screen bg-gray-100">


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

    {{-- <x-skeleton-loader /> --}}


    @livewire('comment-modal')
    @livewireScripts

    <script>
        function sendMessage() {
            const message = document.getElementById('userMessage').value;

            fetch('/chatbot', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message
                    }) // Fixed typo: JSON.stringfy -> JSON.stringify
                })
                .then(response => response.json())
                .then(data => {
                    const chatbox = document.getElementById('chatbox');

                    // Fixed innerHtml -> innerHTML and corrected template literal syntax
                    chatbox.innerHTML += `<p><strong>User:</strong> ${message}</p>`;
                    chatbox.innerHTML += `<p><strong>AI:</strong> ${data.reply}</p>`;
                    document.getElementById('userMessage').value = '';
                })
                .catch(error => console.error('Error:', error)); // Added error handling
        }
    </script>



    <script type="module" src="{{ asset('/js/main.js') }}" defer></script>
    @stack('modals')


</body>

</html>
