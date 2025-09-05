        <x-guest-layout>
        <div class="bg-gray-50 text-black/50">

            <div
                class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

                    <div class="py-4">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" wire:poll.keep-alive>
                                <x-welcome />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </x-guest-layout>