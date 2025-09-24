                @php
                    $formatted = collect(preg_split("/\r\n|\r|\n/", e($blog->description)))
                        ->map(fn($p) => "<p>{$p}</p>")
                        ->implode('');
                @endphp
<div class="bg-gray-50 min-h-screen">
    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex space-x-1">
                <li>
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">Home</a>
                </li>
                <li>
                    <span class="mx-2">/</span>
                </li>
                <li>
                    <a href="{{ route('blog') }}" class="text-gray-500 hover:text-gray-700">Blogs</a>
                </li>
                <li>
                    <span class="mx-2">/</span>
                </li>
                <li class="text-gray-700 font-semibold">{{ $blog->name }}</li>
            </ol>
        </nav>
    </div>

    <!-- Content Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <!-- Featured Image -->
    @if ($blog->media_type === 'image')
        @if ($blog->media_path)
            <img src="{{ asset($blog->media_path) }}" alt="{{ $blog->name }}"
                class="mx-auto mb-4 w-full h-40 rounded-lg" />
        @endif
    @elseif($blog->media_type === 'video')
        <video controls class="w-full h-96 object-cover rounded-3xl">
            <source src="{{ asset($blog->media_path) }}">
            Your browser does not support the video tag.
        </video>
    @endif

        <!-- Title & Meta -->
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
            {{ $blog->title }}
        </h1>
        <div class="flex items-center text-sm text-gray-500 mb-10">
            <span>By {{ $blog->author->name ?? 'Admin' }}</span>
            <span class="mx-2">•</span>
            <span>{{ $blog->created_at->format('F j, Y') }}</span>
        </div>

        <!-- Body -->
        <article class="prose prose-lg prose-gray max-w-none leading-relaxed text-gray-800">
            {!! ($formatted) !!}
        </article>
    </div>
</div>
