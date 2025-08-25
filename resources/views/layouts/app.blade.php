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
    <!-- Logo and App Name at the top of the head visually -->
    <link rel="icon" href="{{ asset('img/logo1.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('img/logo1.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/logo1.png') }}" type="image/png">
    <title>{{ config('app.name', '  VumbiVentures - Discover Africa') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Vite Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="font-body">

    {{-- <x-banner /> --}}

    <div class="min-h-screen bg-gray-100">
        @include('livewire.layout.navigation')

        <!-- Page Content -->
        <div>
            {{ $slot }}
            {{-- @livewire('spa-container') --}}
        </div>



    </div>
    @livewire('comment-modal')

    @livewireScripts
    {{-- <x-skeleton-loader /> --}}
    {{-- <script src="{{ asset('/public/build/assets/app-DqMUDAdC.js') }}" defer></script> --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('commentModal', {
                isOpen: false,
                commentableId: null,
                commentableType: null,
                commentableModel: null,

                open(commentableId, commentableType, modelData = null) {
                    this.commentableId = commentableId;
                    this.commentableType = commentableType;
                    this.commentableModel = modelData;
                    this.isOpen = true;
                },

                close() {
                    this.isOpen = false;
                    this.commentableId = null;
                    this.commentableType = null;
                    this.commentableModel = null;
                },

                getCommentableTitle() {
                    if (!this.commentableModel) return 'Item';

                    return this.commentableModel.title ||
                        this.commentableModel.name ||
                        this.commentableModel.subject ||
                        'Item';
                }
            });
        });
    </script>

    <script type="module" src="{{ asset('/js/main.js') }}" defer></script>

    @stack('modals')

</body>

</html>
