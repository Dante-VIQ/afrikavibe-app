<x-app-layout>
    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-5">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">
                <section id="subscribe">

                    <h2>Subscribe to Our Newsletter</h2>
                    <form action="/" method="POST">
                        <x-input type="email" name="email" placeholder="Enter your email" class="input-sub input-lg"
                            required />
                        <x-button type="submit">Subscribe</x-button>
                    </form>
                </section>

                {{-- blog read --}}
                <div class="blog_section">
                    <div class="tag_section tag_center">
                        <h6 class="text-lg-center p-5">Popular Blogs</h6>
                        <div class="tag_indicator">
                            <div class="line"></div>
                            <div class="circle"></div>

                        </div>
                    </div>

                    <div class="blog_section_box">
                        @unless (count($blogs) == 0)

                            @foreach ($blogs as $blog)
                                <x-blog-card :blog="$blog" />
                            @endforeach
                        @else
                            <p class="text-white">No blogs found</p>
                        @endunless

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
