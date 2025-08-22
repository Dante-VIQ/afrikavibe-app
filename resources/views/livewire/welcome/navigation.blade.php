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
                    <x-nav-link wire:click="$emit('navigateTo', 'doctors')" href="doctors" :active="request()->routeIs('doctors')">
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
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
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
        <div class="pt-4 pb-1 border-t border-gray-200 text-gray-700">
            <div class="mt-3 space-y-1">
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
    </div>
</nav>
