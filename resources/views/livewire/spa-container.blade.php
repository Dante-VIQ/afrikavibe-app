<div x-data="{ show: true, loading: false }" x-init="$watch('$wire.page', () => {
    show = false;
    loading = true;
    setTimeout(() => { loading = false; show = true }, 200)
    })" class="relative">
    {{-- The whole world belongs to you. --}}
    {{-- <div x-show="loading" x-transition.opacity.duration.500ms
        class="fixed inset-0 flex flex-col items-center justify-center bg-gradient-to-br from-yellow-500 via-black to-gray-900 text-white z-50">
        <div class="flex flex-col items-center animate-pulse">
            <svg class="w-20 h-20 text-yellow-400 animate-spin-slow" fill="none" viewBox="0 0 48 48" stroke="currentColor">
                <circle class="opacity-25" cx="24" cy="24" r="20" stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor" d="M24 4a20 20 0 0120 20h-4a16 16 0 10-16 16v4A20 20 0 0124 4z" />
            </svg>
            <h1 class="text-4xl md:text-6xl font-extrabold mt-6 tracking-tight drop-shadow-lg">
                Vumbi Ventures
            </h1>
            <p class="mt-4 text-lg md:text-xl text-yellow-200 font-medium animate-bounce">Loading Your Adventure...</p>
        </div>
    </div> --}}

    <template x-if="show">
        <div x-transition.opacity.duration-500ms>
            {{-- Example navigation (replace with your actual nav): --}}
            {{-- <nav class="flex gap-4 mb-4">
                <a href="#" wire:click.prevent="$emit('navigateTo', 'welcome')">Home</a>
                <a href="#" wire:click.prevent="$emit('navigateTo', 'dashboard')">Dashboard</a>
                <a href="#" wire:click.prevent="$emit('navigateTo', 'destination')">Destinations</a>
                <a href="#" wire:click.prevent="$emit('navigateTo', 'art')">Art</a>
                <a href="#" wire:click.prevent="$emit('navigateTo', 'blog')">Blog</a>
            </nav> --}}
            @switch($page)
                @case('welcome')
                    <livewire:welcome />
                @break
                @case('dashboard')
                    {{-- <livewire:header-page /> --}}
                    <livewire:dashboard />
                @break
                @case('destination')
                    <livewire:doctor-page />
                @break
                @case('art')
                    <livewire:culture-page />
                @break
                @case('blog')
                    <livewire:blog-page />
                @break
                @default
                    <livewire:not-found />
            @endswitch
        </div>
    </template>



    {{-- @livewire($component, $routeParams, key($currentRoute . json_encode($routeParams))) --}}

</div>
