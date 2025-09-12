<div x-show="open" class="fixed rounded-lg">
<div
    class="bg-white rounded-2xl shadow-lg max-w-7xl w-full p-6 overflow-y-auto max-h-[90vh] relative
        sm:max-w-md sm:p-4 sm:rounded-xl
        xs:max-w-xs xs:p-2 xs:rounded-lg"
    @click.away="open = false">
    <!-- Close Button -->
    <div>
        <button class="absolute top-2 right-2 text-gray-600 hover:text-black p-3 sm:p-2 xs:p-1" @click="open = false">
            ✕
        </button>
    </div>
    <!-- Full Content -->
    <div class="space-y-4">
        {{ $slot }}
    </div>
</div>
</div>