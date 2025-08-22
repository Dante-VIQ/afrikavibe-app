@extends('layouts.dashboard')
    <div class="py-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
             <livewire:blog-page />
            </div>
        </div>
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
