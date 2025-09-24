@php
    $formatted = collect(preg_split("/\r\n|\r|\n/", e($doctor->detail)))
        ->map(fn($p) => "<p>{$p}</p>")
        ->implode('');
@endphp

<x-slot name="photo">
    <div class="flex justify-between items-center mb-3 text-gray-500">
        <span class="bg-primary-100 text-gray-700 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
            <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                </path>
            </svg>
            {{ $doctor->category }}
        </span>
        {{-- <span class="text-sm">{{ $blog->created_at }}</span> --}}
    </div>
    @if ($doctor->media_type === 'image')
        @if ($doctor->media_path)
            <img src="{{ asset($doctor->media_path) }}" alt="{{ $doctor->title }}"
                class="mx-auto mb-4 w-full h-40 rounded-lg" />
        @endif
    @elseif($doctor->media_type === 'video')
        <video controls class="w-full h-96 object-cover rounded-3xl">
            <source src="{{ asset($doctor->media_path) }}">
            Your browser does not support the video tag.
        </video>
    @endif

</x-slot>
<x-slot name="content">
    <h3 class="mb-1 text-xl sm:text-2xl font-semibold text-green-700 fix-underline">
        {{ $doctor->name }}
    </h3>
    {{-- <p>{{ $doctor->department }}</p> --}}

    <p class="h-24 text-sm text-gray-700 mb-3 overflow-hidden text-wrap">
        {!! $doctor->detail !!}
    </p>


    <div x-data="{ open: false }" class="flex justify-evenly" x-cloak>
        <button class="mt-2 px-4 py-1 bg-orange-500 rounded-full text-white hover:bg-orange-600"
            wire:click="$dispatch('openCommentModal', {
                                  commentableId: {{ $doctor->id }},
                                    commentableType: 'App\Models\Doctor' })">
            💬 Comment
            @if ($doctor->comments_count > 0)
                <span class="ml-2 text-xs bg-white/20 px-2 py-0.5 rounded-full">
                    {{ $doctor->comments_count }}
                </span>
            @endif
        </button>
 

           <a href="{{ route('Partials.doctor', $doctor) }}" class="read-more-button">
        Read More
    </a>

    </div>
</x-slot>
