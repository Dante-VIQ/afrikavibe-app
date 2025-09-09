<div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-transition>
    <div class="bg-white rounded-2xl shadow-lg max-w-3xl w-full p-6 overflow-y-auto max-h-[90vh] relative"
        @click.away="open = false">
        <!-- Close Button -->
        <button class="absolute top-4 right-4 text-gray-600 hover:text-black p-3" @click="open = false">
            ✕
        </button>
        <!-- Full Content -->
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
