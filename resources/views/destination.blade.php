<x-guest-layout>
<div>
    <livewire:doctor-page :doctor="$doctor" :key="$doctor->id" lazy />
    {{-- <x-destinations /> --}}
</div>
</x-guest-layout>
