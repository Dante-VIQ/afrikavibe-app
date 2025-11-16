<div>
    <div>
        <div class="w-full bg-white py-8">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 px-6">

                <!-- Left: Headline -->
                <div class="flex flex-col justify-center">
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                        Explore Africa Your Way
                    </h1>
                    <p class="text-md italic text-gray-600">
                        Adventure, Luxury, and Culture, Your journey starts here.
                    </p>

                    {{-- @livewire('trip-planner')

                    @if (request()->has('q'))
                        @livewire('search-results', ['q' => request('q')])
                    @endif --}}
                    <div x-data="{ open: false }" class="relative" x-cloak>
                        <x-button @click="open = !open" class="mt-4 bg-teal-600 hover:bg-teal-700">
                            Plan Your Trip
                        </x-button>
                        <div x-show="open"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-80 px-2">
                            <div class="w-full max-w-lg sm:max-w-md md:max-w-lg lg:max-w-xl bg-white rounded-lg shadow-lg p-4 sm:p-6 md:p-8 relative overflow-y-auto max-h-[90vh]" x-on:click.outside.prevent="open = false">
                                <button @click="open = false"
                                    class="absolute top-2 right-2 sm:top-4 sm:right-4 text-gray-500 hover:text-gray-700 text-2xl sm:text-3xl">&times;</button>
                                <!-- Place your form or content here -->
                                <script async
                                    src="https://tpscr.com/content?currency=usd&trs=465487&shmarker=677991&locale=en&powered_by=true&limit=4&primary_color=00AE98&results_background_color=FFFFFF&form_background_color=FFFFFF&campaign_id=111&promo_id=3411"
                                    charset="utf-8"></script>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Unique Social-Style Grid -->

                {{-- image/video slider --}}
                <div>

                    <livewire:header-media-feed />
                </div>

            </div>
        </div>
    </div>
</div>
