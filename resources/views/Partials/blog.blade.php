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