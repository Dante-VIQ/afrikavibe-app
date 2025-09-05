@isset($partners)
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Our Partners</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($partners as $partner)
            <x-partner-card :partner="$partner" />
        @endforeach
    </div>

</div>
@endisset