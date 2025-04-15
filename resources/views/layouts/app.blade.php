<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="keywords" content="Africa travel, African culture, African destinations, Explore Africa, travel blog, African art, African history, African cuisine.">
        <meta name="description" content="Discover the rich tapestry of Africa's diverse cultures, breathtaking landscapes, and unique experiences. Explore top travel destinations, art, history, and cuisine on AfrikaVibe.">
        <title>{{ config('app.name', 'AfriWise - Discover Africa') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('/lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/resources/css/output.css') }}" rel="stylesheet">
        <link href="{{ asset('./fontawesome6/css/all.min.css') }}" rel="stylesheet">

        <!-- Owl Carousel Stylesheet -->
        <link rel="stylesheet" href="{{ asset('/lib/owlcarousel/assets/owl.carousel.min.css') }}" />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class', // Corrected from 'true' to 'class'
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                "50": "#eff6ff",
                                "100": "#dbeafe",
                                "200": "#bfdbfe",
                                "300": "#93c5fd",
                                "400": "#60a5fa",
                                "500": "#3b82f6",
                                "600": "#2563eb",
                                "700": "#1d4ed8",
                                "800": "#1e40af",
                                "900": "#1e3a8a",
                                "950": "#172554"
                            }
                        }
                    },
                    fontFamily: {
                        'body': [
                            'Inter',
                            'ui-sans-serif',
                            'system-ui',
                            '-apple-system',
                            'Segoe UI',
                            'Roboto',
                            'Helvetica Neue',
                            'Arial',
                            'Noto Sans',
                            'sans-serif',
                            'Apple Color Emoji',
                            'Segoe UI Emoji',
                            'Segoe UI Symbol',
                            'Noto Color Emoji'
                        ],
                        'sans': [
                            'Inter',
                            'ui-sans-serif',
                            'system-ui',
                            '-apple-system',
                            'Segoe UI',
                            'Roboto',
                            'Helvetica Neue',
                            'Arial',
                            'Noto Sans',
                            'sans-serif',
                            'Apple Color Emoji',
                            'Segoe UI Emoji',
                            'Segoe UI Symbol',
                            'Noto Color Emoji'
                        ]
                    }
                }
            }
        </script>

        <!-- Vite Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Livewire Styles -->
        @livewireStyles
    </head>
    <body class="font-sans">

        {{-- <x-banner /> --}}

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

            <!-- Page Content -->
            <div>
                {{ $slot }}
            </div>
        </div>

        <script>
            function sendMessage() {
                const message = document.getElementById('userMessage').value;

                fetch('/chatbot', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message }) // Fixed typo: JSON.stringfy -> JSON.stringify
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

        <!-- Additional Scripts -->
        <script src="{{ asset('/lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('/lib/counterup/counterup.min.js') }}"></script>
        <script src="{{ asset('/lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('/js/main.js') }}"></script>
        <script src="{{ asset('/fontawesome6/js/all.min.js') }}"></script>
        <script src="/node_modules/jquery/dist/jquery.js"></script>
        <script src="{{ asset('/lib/tempusdominus/js/moment.min.js') }}"></script>
        <script src="{{ asset('/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
        <script src="{{ asset('/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

        @stack('modals')

        @livewireScripts
    </body>
</html>