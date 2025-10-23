<x-app-layout>
    @if(request()->has('q'))
      @livewire('search-results', ['q' => request('q')])
    @endif
</x-app-layout>
