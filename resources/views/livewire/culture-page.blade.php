<div>
    <div class="grid lg:grid-cols-2 gap-3 p-3 sm:grid-cols-1 md:grid-cols-2 fix-underline wow FadeInUp">
        @unless (count($cultures) == 0)
            @foreach ($cultures as $culture)
                <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md">
                    <div class="flex justify-between items-center mb-3 text-gray-500">
                        <span
                            class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
                            <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                </path>
                            </svg>
                            Tutorial
                        </span>
                        {{-- <span class="text-sm">{{ $blog->created_at }}</span> --}}
                    </div>
                    <h2 class="mb-2 text-xl sm:text-2xl font-semibold text-green-700">{{ $culture->name }}</h2>
                    <p class="mb-5 text-sm text-gray-700 h-40 overflow-hidden text-wrap">
                        {{ $culture->detail }}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            @if($culture->image)
                                <img class="w-7 h-7 rounded-full" src="{{ asset($culture->image) }}" alt="Culture image" />
                            @endif
                        <!-- If culture images are stored, use uploads folder: -->
                        <!-- <img class="w-7 h-7 rounded-full" src="{{ asset('uploads/' . basename($culture->image)) }}" alt="Culture image" /> -->
                            <span class="font-medium">
                                {{ $culture->user->name }}
                            </span>
                        </div>
                                              <div x-data="{ open: false }" class="flex" x-cloak>
                            <button class="mt-2 px-4 py-1 bg-orange-500 rounded-full text-white hover:bg-orange-600"
                                wire:click="$dispatch('openCommentModal', {
                                  commentableId: {{ $culture->id }},
                                    commentableType: 'App\Models\Culture' })">
                                💬
                                @if ($culture->comments_count > 0)
                                    <span class="ml-2 text-xs bg-white/20 px-2 py-0.5 rounded-full">
                                        {{ $culture->comments_count }}
                                    </span>
                                @endif
                            </button>

                            
                            <button @click="open = true" class="mt-3 text-blue-600 font-semibold hover:underline">
                                Read more →
                            </button>

                            <x-read-more-card>
                                <div>
                                    @if ($culture->media_type === 'image')
                                        @if ($culture->media_path)
                                            <img src="{{ asset($culture->media_path) }}" alt="{{ $culture->name }}"
                                                class="mx-auto mb-4 w-full h-40 rounded-lg" />
                                        @endif
                                    @elseif($culture->media_type === 'video')
                                        <video controls class="w-full h-96 object-cover rounded-3xl">
                                            <source src="{{ asset($culture->media_path) }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                </div>

                                <slot name="content">

                                    <h3 class="mb-1 text-xl sm:text-2xl font-semibold text-green-700 fix-underline">
                                        {{ $culture->name }}
                                    </h3>
                                    <div class="text-sm text-gray-700 mb-3">
    {!! $culture->detail !!}
</div>
                                </slot>
                            </x-read-more-card>
                        </div>
                    </div>


                </article>
            @endforeach
        @else
            <p class="text-black-italic text-lg text-center">No Culture At The Moment</p>
        @endunless

    </div>
    <div class="mt-12 text-center">
        <a href="/art"
            class="inline-block bg-green-700 text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-green-800 transition">
            Discover More Cultures
        </a>
    </div>
</div>
