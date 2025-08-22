<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <livewire:culture-page />
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
        window.contentData = @json([
            'id' => $culture->id,
            'type' => 'culture'
        ]);
    </script>

    @vite(['resources/js/content-tracking.js'])
@endsection
</x-app-layout>
