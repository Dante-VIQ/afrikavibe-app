<x-slot name="photo">
    <img class="mx-auto mb-4 w-full h-40 rounded-lg" src="{{ asset('storage/' . $doctor->image) }}" />

</x-slot>
<x-slot name="content">
    <h3 class="mb-1 text-xl sm:text-2xl font-semibold text-green-700 fix-underline">
        {{ $doctor->name }}
    </h3>
    {{-- <p>{{ $doctor->department }}</p> --}}
    <p class="h-[40vh] text-sm text-gray-700 mb-3 overflow-y-hidden overflow-y-ellipsis">{{ $doctor->detail }}</p>

    <div class="flex justify-evenly">
            <button class="mt-2 px-4 py-1 bg-orange-500 rounded-full text-white hover:bg-orange-600"
                                    wire:click="$dispatch('openCommentModal', {
                                  commentableId: {{ $doctor->id }},
                                    commentableType: 'App\Models\Doctor' })">
                                    💬
                                    @if ($doctor->comments_count > 0)
                                        <span class="ml-2 text-xs bg-white/20 px-2 py-0.5 rounded-full">
                                            {{ $doctor->comments_count }}
                                        </span>
                                    @endif
                                </button>
        <a class="btn" href=""><i class="fa fa-plus text-blue-700 me-2 m-2"></i>Read More</a>
    </div>
</x-slot>
