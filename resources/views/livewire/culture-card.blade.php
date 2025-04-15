<div>
    <div class="grid lg:grid-cols-2 gap-3 p-3 sm:grid-cols-1 md:grid-cols-2 fix-underline wow FadeInUp">
        @unless (count($cultures) == 0)
            @foreach ($cultures as $culture)
                <article
                    class="p-6 bg-white rounded-lg border border-gray-200 shadow-md">
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
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 "><a
                            href="#">{{ $culture->name }}</a></h2>
                    <p class="mb-5 font-light text-gray-500 h-40 overflow-hidden text-wrap">
                        {{ $culture->detail }}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <img class="w-7 h-7 rounded-full" src="{{ $culture->user->profile_photo_url }}"
                                alt="Jese Leos avatar" />
                            <span class="font-medium">
                                {{ $culture->user->name }}
                            </span>
                        </div>
                        <a href="/cultures/{{ $culture->id }}"
                            class="inline-flex items-center font-medium text-primary-600 hover:underline italic">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>

                </article>
            @endforeach
        @else
            <p class="text-black-italic text-lg text-center">No Culture At The Moment</p>
        @endunless
    </div>
    {{-- <div class="flex"> --}}
    {{-- @can('create', $culture) --}}
    <div class="relative p-5 mx-auto" x-data="{ show: false }">
        <x-button x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                class="fa fa-add text-primary"></i>
            Add Culture</x-button>

        <div class="mx-auto z-9 top-1/3 left-1/3" x-show="show" x-on:click.outside.prevent="show = false">
            @include('livewire.includes.culture-create')
        </div>
    </div>
    {{-- @endcan --}}

    {{-- </div> --}}
</div>
