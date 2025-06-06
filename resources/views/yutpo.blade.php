@props(['blog'])
<!--
Install the "flowbite-typography" NPM package to apply styles and format the article content:

URL: https://flowbite.com/docs/components/typography/
-->
<x-app-layout>
    <div class="row g-5">
    <div class="py-20 col-lg-8 col-md-6">
        <div class="pt-16 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
            <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
                <article
                    class="mx-auto w-full max-w-xl format format-sm sm:format-base lg:format-lg format-blue">

                    <header class="mb-4 lg:mb-6 not-format">
                        <address class="flex items-center mb-6 not-italic">
                            <div class="inline-grid items-center mr-3 text-sm text-gray-600">
                                {{-- <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a> --}}

                                <a href="#"
                                    class="text-3xl font-semiBold hover:text-gray-700 pb-4 outline-none">{{ $blog->title }}</a>
                                <p href="#" class="text-sm pb-3">
                                    By <a href="#"
                                        class="font-semibold hover:text-gray-800">{{ $blog->user->name }}</a>,
                                    {{ $blog->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </address>

                    </header>
                    <p class="w-full ">{{ $blog->description }}</p>

            <livewire:comment :$comments="comment" />

                </article>
            </div>
        </div>
    </div>
    <aside aria-label="Related articles" class="col-lg-4 col-md-6 py-8 lg:py-24 bg-gray-50">
        <div class="px-4 mx-auto lg:max-w-screen-xl sm:max-w-screen">
            <h2 class="mb-8 text-2xl font-bold text-gray-900">Related articles</h2>
            <div class="flex">
                @foreach ($this->blogs as $blog)
                <article wire:key="{{ $blog->id }}" class="">
                    <a href="#">
                        <img src="{{ asset('storage/' . $blog->image) }}" class="mb-5 rounded-lg" alt="Image 1">
                    </a>
                    <h2 class="mb-2 text-xl font-semibold text-gray-900 outline-none">
                        <a href="#">{{ $blog->title }}</a>
                    </h2>
                    {{-- <p class="mb-4 overflow-hidden text-gray-500 h-32 max-h-screen">{{ $blog->description }}</p> --}}
                    <a href="#"
                        class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 hover:no-underline">
                        Read in 2 minutes
                    </a>
                </article>
                @endforeach

            </div>
        </div>
    </aside>
</div>

   <livewire:footer-card />

</x-app-layout>
