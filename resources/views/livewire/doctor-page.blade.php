<div>
    <section class="bg-white px-4 mx-auto max-w-screen-xl text-center lg:py-8 lg:px-6">
        <!-- Full Page Skeleton Loader (shown during Livewire loading) -->
        <div class="w-full min-h-screen bg-gray-200 dark:bg-gray-800 animate-pulse fixed inset-0 z-50" wire:loading.flex>
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 py-10 px-6">
                <div class="space-y-4">
                    <div class="h-12 bg-gray-300 dark:bg-gray-700 rounded w-3/4"></div>
                    <div class="h-5 bg-gray-300 dark:bg-gray-700 rounded w-5/6"></div>
                    <div class="h-5 bg-gray-300 dark:bg-gray-700 rounded w-2/3"></div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="h-48 bg-gray-300 dark:bg-gray-700 rounded-xl"></div>
                    @endfor
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 space-y-6 mt-6">
                @for ($i = 0; $i < 4; $i++)
                    <div class="h-40 bg-gray-300 dark:bg-gray-700 rounded-xl"></div>
                @endfor
            </div>
        </div>
        <div class="grid gap-4 lg:gap-8 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 wow FadeInUp"
            data-wow-delay="0.1s">

            @unless (count($doctors) == 0)
                @foreach ($doctors as $doctor)
                    <x-destination-card wire:loading.remove>
                        @include('livewire.includes.doctor-show')
                    </x-destination-card>
                @endforeach
            @else
                <p class="text-black-italic text-lg text-center">No Destinations At The Moment</p>
            @endunless
        </div>
        <div class="mt-12 text-center">
            <a href="/destination"
                class="inline-block bg-green-700 text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-green-800 transition">
                Discover More Destinations
            </a>
        </div>
    </section>
    <x-section-border />
    <div>
        {{-- <livewire:service-list lazy /> --}}
        <x-eco--tours />
    </div>
</div>
