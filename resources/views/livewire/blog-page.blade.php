<div>
    <div class="grid lg:grid-cols-3 p-3 md:grid-cols-2 gap-4 sm:grid-cols-1 fix-underline wow FadeInUp">
        @unless (count($blogs) == 0)
            @foreach ($blogs as $blog)
@php
    $formatted = collect(preg_split("/\r\n|\r|\n/", e($blog->description)))
    ->map(fn($p) => "<p>{$p}</p>")
        ->implode('');
@endphp

                <article wire:key="{{ $blog->id }}"
                    class="service-item p-6 bg-white rounded-lg border border-gray-200 shadow-md">

                    <div class="flex justify-between items-center mb-3 text-gray-500">
                        <span
                            class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
                            <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                </path>
                            </svg>
                            {{ $blog->category }}
                        </span>
                        {{-- <span class="text-sm">{{ $blog->created_at }}</span> --}}
                    </div>
                    <!-- Article Image -->
                    <a href="/blogs/{{ $blog->id }}" class="hover:opacity-75 background-cover">
                        {{-- <a href="#">
                            <p class="text-gray-500 text-sm font-bold pb-4 uppercase fix-underline">
                                {{ $blog->category }}</p>
                        </a> --}}


                        @if ($blog->media_type === 'image')
                            @if ($blog->media_path)
                                <img src="{{ asset($blog->media_path) }}" alt="{{ $blog->title }}"
                                    class="mx-auto mb-4 w-full h-40 rounded-lg" />
                            @endif
                        @elseif($blog->media_type === 'video')
                            <video controls class="w-full h-96 object-cover rounded-3xl">
                                <source src="{{ asset($blog->media_path) }}">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </a>

                    <div class="bg-white flex flex-col justify-between">
                        <h3 class="text-xl sm:text-2xl font-semibold text-green-700  mb-2">{{ $blog->title }}</h3>
                        <p class="text-sm pb-3">
                            By <i class=" hover:text-gray-800">{{ $blog->user->name }}</i>,
                            {{ $blog->created_at->diffForHumans() }}
                        </p>
                        <p class="mb-6 h-24 text-sm text-gray-700 overflow-hidden text-wrap">{{ $blog->description }}</p>
                        <div x-data="{ open: false }" class="flex" x-cloak>
                            <button class="mt-2 px-4 py-1 bg-orange-500 rounded-full text-white hover:bg-orange-600"
                                wire:click="$dispatch('openCommentModal', {
                                  commentableId: {{ $blog->id }},
                                    commentableType: 'App\Models\Blog' })">
                                💬
                                @if ($blog->comments_count > 0)
                                    <span class="ml-2 text-xs bg-white/20 px-2 py-0.5 rounded-full">
                                        {{ $blog->comments_count }}
                                    </span>
                                @endif
                            </button>

                            {{-- <a href="/blogs/{{ $blog->id }}" class="text-gray-800 hover:text-black italic">Continue
                                Reading <i class="fas fa-arrow-right"></i></a> --}}
                            <button @click="open = true" class="mt-3 text-blue-600 font-semibold hover:underline">
                                Read more →
                            </button>

                            <x-read-more-card>
                                <div>
                                    @if ($blog->media_type === 'image')
                                        @if ($blog->media_path)
                                            <img src="{{ asset($blog->media_path) }}" alt="{{ $blog->title }}"
                                                class="mx-auto mb-4 w-full h-40 rounded-lg" />
                                        @endif
                                    @elseif($blog->media_type === 'video')
                                        <video controls class="w-full h-96 object-cover rounded-3xl">
                                            <source src="{{ asset($blog->media_path) }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                </div>

                                <slot name="content">

                                    <h3 class="mb-1 text-xl sm:text-2xl font-semibold text-green-700 fix-underline">
                                        {{ $blog->title }}
                                    </h3>
                                                                        <div class="text-sm text-gray-700 mb-3">
                                        {!! $formatted !!}
                                    </div>
                                </slot>
                            </x-read-more-card>
                        </div>
                    </div>


                </article>
            @endforeach
        @else
            <p class="text-black-italic text-lg text-center">No Blog At The Moment</p>
        @endunless

    </div>
    <div class="mt-12 text-center">
        <a href="/blog"
            class="inline-block bg-green-700 text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-green-800 transition">
            Read More Blogs
        </a>
    </div>

    @push('scripts')
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1920954764751411"
            crossorigin="anonymous"></script>
        <ins class="adsbygoogle" style="display:block" data-ad-format="fluid" data-ad-layout-key="-5b+cl-e-8b+of"
            data-ad-client="ca-pub-1920954764751411" data-ad-slot="5750592805"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    @endpush

    {{-- <div class="flex">
        @can('create', $blog)
            <div class="relative p-5 mx-auto" x-data="{ show: false }">
                <x-button x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                        class="fa fa-add text-primary"></i>
                    Add Blog</x-button>

                <div class="mx-auto z-9 top-1/3 left-1/3" x-show="show" x-on:click.outside.prevent="show = false">
                    @include('livewire.includes.blog-create')
                </div>
            </div>
        @endcan
    </div> --}}
</div>
