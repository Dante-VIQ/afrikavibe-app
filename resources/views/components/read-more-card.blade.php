<div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-transition>
    <div class="bg-white rounded-2xl shadow-lg max-w-7xl w-full p-6 overflow-y-auto max-h-[90vh] relative"
        @click.away="open = false">
        <!-- Close Button -->
        <div>
            <button class="absolute top-4 right-4 text-gray-600 space-y-4 hover:text-black p-3" @click="open = false">
                ✕
            </button>
        </div>
        <!-- Full Content -->
        <div class="space-y-4 ">
            {{ $slot }}
        </div>
    </div>
</div>
