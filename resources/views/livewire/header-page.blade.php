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

                    @Include('Partials._search')
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
