<x-app-layout>

    <article wire:key="{{ $blog->id }}" class=" bg-gray-100">
        <div class="flex flex-col items-center justify-center text-center text-white p-10">
            <img class="w-64 mr-6 mb-6"
                src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('/images/no-image.png') }}"
                alt="" />

            <h3 class="text-2xl mb-2">
                {{ $blog->title }}
            </h3>
            <div class="text-xl font-bold mb-4">{{ $blog->category }}</div>

            {{-- <x-listing-tags :tagsCsv="$listing->tags" /> --}}

            <div class="text-lg my-4">
                <i class="fa-solid fa-location-dot"></i> {{ $blog->location }}
            </div>
            <div class="border border-gray-200 w-full mb-6"></div>
            <div>
                <h3 class="text-3xl font-bold mb-4">Description</h3>
                <div class="text-lg space-y-4">
                    {{ $blog->description }}


                </div>
            </div>
            {{-- <livewire:comments :model="blog" /> --}}
        </div>
    </article>

    <div class="mt-4 p-2 flex space-x-6">
        <a href="/blogs/{{ $blog->id }}/edit">
            <i class="fa-solid fa-pencil"></i> Edit
        </a>
    </div>

    @section('scripts')
    <script>
        window.contentData = @json([
            'id' => $blog->id,
            'type' => 'blog'
        ]);
    </script>

@vite(['resources/js/content-tracking.js'])
    @endsection
</x-app-layout>
