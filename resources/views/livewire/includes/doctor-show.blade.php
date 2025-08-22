<x-slot name="photo">
    <img class="mx-auto mb-4 w-full h-40 rounded-lg" src="{{ asset('storage/' . $doctor->image) }}" />

</x-slot>
<x-slot name="content">
    <h3 class="mb-1 text-xl sm:text-2xl font-semibold text-green-700 fix-underline">
        {{ $doctor->name }}
    </h3>
    {{-- <p>{{ $doctor->department }}</p> --}}
    <p class="h-15 max-h-full text-sm text-gray-700 mb-3 overflow-y-ellipsis">{{ $doctor->detail }}</p>

    <div class="flex justify-evenly">
          <button 
            x-on:click="$dispatch('openCommentModal', { type: 'App\\Models\\Doctor', id: {{ $doctor->id }} })"
            class="mt-3 text-sm h-8 bg-amber-600 hover:bg-amber-700 text-white p-2 rounded-lg">
            💬
        </button>
        <a class="btn" href=""><i class="fa fa-plus text-blue-700 me-2 m-2"></i>Read More</a>
    </div>
</x-slot>
