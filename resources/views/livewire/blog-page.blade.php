<div>
    <div class="grid lg:grid-cols-3 p-3 md:grid-cols-2 gap-4 sm:grid-cols-1 fix-underline wow FadeInUp">
        @unless (count($blogs) == 0)
            @foreach ($blogs as $blog)
                <article wire:key="{{ $blog->id }}"
                    class="service-item p-6 bg-white rounded-lg border border-gray-200 shadow-md">
                    <!-- Article Image -->
                    <a href="/blogs/{{ $blog->id }}" class="hover:opacity-75 background-cover">
                        {{-- <a href="#">
                            <p class="text-gray-500 text-sm font-bold pb-4 uppercase fix-underline">
                                {{ $blog->category }}</p>
                        </a> --}}
                        <img class="mx-auto mb-4 w-full h-40 rounded-lg" src="{{ asset('storage/' . $blog->image) }}"
                            alt="{{ $blog->category }}" />
                    </a>

                    <div class="bg-white flex flex-col justify-between">
                        <h3 class="text-xl sm:text-2xl font-semibold text-green-700  mb-2">{{ $blog->title }}</h3>
                        <p class="text-sm pb-3">
                            By <i class=" hover:text-gray-800">{{ $blog->user->name }}</i>,
                            {{ $blog->created_at->diffForHumans() }}
                        </p>
                        <p class="mb-6 h-24 text-sm text-gray-700 overflow-hidden text-wrap">{{ $blog->description }}</p>
                        <div class="flex">
                            <button
                                wire:click="$emit('openCommentModal', { type: 'App\\Models\\Blog', id: {{ $blog->id }} })"
                                class="mt-3 text-sm bg-amber-600 hover:bg-amber-700 text-white px-3 py-1 rounded-lg">
                                💬
                            </button>

                            <a href="/blogs/{{ $blog->id }}" class="text-gray-800 hover:text-black italic">Continue
                                Reading <i class="fas fa-arrow-right"></i></a>

                        </div>
                    </div>


                </article>
            @endforeach
        @else
            <p class="text-black-italic text-lg text-center">No Blog At The Moment</p>
        @endunless

    </div>
    <div class="mt-12 text-center">
        <a href="/main"
            class="inline-block bg-green-700 text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-green-800 transition">
            Read More Blogs
        </a>
    </div>


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
