<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 items-center justify-center">
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->

                <div class="flex items-center sm:-my-px sm:ms-10">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block text-2xl" />
                        <x-application-name class="block h-9 w-auto fill-current text-gray-800" />

                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link wire:click="$emit('navigateTo', 'dashboard')" href="/dashboard" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link wire:click="$emit('navigateTo', 'destination')" href="destination" :active="request()->routeIs('doctors')">
                        {{ __('Destinations') }}
                    </x-nav-link>
                    <x-nav-link wire:click="$emit('navigateTo', 'art')" href="/art" :active="request()->routeIs('art')">
                        {{ __('Culture') }}
                    </x-nav-link>
                    <x-nav-link wire:click="$emit('navigateTo', 'blog')" href="/blog" :active="request()->routeIs('blog')">
                        {{ __('Blog') }}
                    </x-nav-link>
                </div>
            </div>
                {{-- <form action="/" method="POST" class="me-3">
                    @csrf
                    <label for="search" class="text-sm hidden"> Search </label>
                    <input name="search" id="search" class="form-control rounded-xl p-3 border-2 border-x-gray-500 " placeholder="Search wih AI" type="text">
                </form> --}}
            <!-- Login/Register Links -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-gray-800 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] ">
                        {{ __('Log in') }}
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-gray-800 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                            {{ __('Register') }}
                        </a>
                    @endif
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden justify-center space-y-2 max-h-full">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link wire:click="$emit('navigateTo', 'destination')" href="/destination">
                {{ __('Destinations') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link wire:click="$emit('navigateTo', 'art')" href="/art">
                {{ __('Culture') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link wire:click="$emit('navigateTo', 'blog')" href="/blog">
                {{ __('Blog') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200 text-gray-700 bottom-0 h-full max-h-full>
            <div class="mt-3
            space-y-1">
            <x-responsive-nav-link :href="route('login')">
                {{ __('Log in') }}
            </x-responsive-nav-link>
            @if (Route::has('register'))
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endif
        </div>
    </div>
    {{-- <nav class="main">
            <ul>
                <li class="search">
                    <a class="fa-search" href="#search">Search</a>
                    <form id="search" method="get" action="#">
                        <input type="text" name="query" placeholder="Search" />
                    </form>
                </li>
                <li class="menu">
                    <a class="fa-bars" href="#menu">Menu</a>
                </li>
            </ul>
        </nav>
        <section id="menu">

            <!-- Search -->
            <section>
                <form class="search" method="get" action="#">
                    <input type="text" name="query" placeholder="Search" />
                </form>
            </section>

            <!-- Links -->
            <section>
                <ul class="links">
                    <li>
                        <a href="#">
                            <h3>Lorem ipsum</h3>
                            <p>Feugiat tempus veroeros dolor</p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h3>Dolor sit amet</h3>
                            <p>Sed vitae justo condimentum</p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h3>Feugiat veroeros</h3>
                            <p>Phasellus sed ultricies mi congue</p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h3>Etiam sed consequat</h3>
                            <p>Porta lectus amet ultricies</p>
                        </a>
                    </li>
                </ul>
            </section>

            <!-- Actions -->
            <section>
                <ul class="actions stacked">
                    <li><a href="#" class="button large fit">Log In</a></li>
                </ul>
            </section>

        </section> --}}
    </div>

</nav>
