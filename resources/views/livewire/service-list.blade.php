<div>
    <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($services) == 0)
            @foreach ($services as $service)
                @include('livewire.includes.service-box')
            @endforeach

            {{-- {{ $services->links() }} --}}
        @else

            <p class="text-black-text-lg text-center italic align-items-center">Services Are Not Available At The Moment.</p>
        @endunless
    </div>


    {{-- @can('create', $service)


        <div class="absolute p-5 mx-auto" x-data="{ show: false }" x-cloak>
            <x-button x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                    class="fa fa-add text-primary"></i>
                Add Service</x-button>

            <div class="mx-auto z-9 top-1/3 left-1/3" x-show="show" x-on:click.outside.prevent="show = false">
                @include('livewire.includes.service-create')

                <button @click="open = false">close</button>
             <script>
                document.addEventListener('livewire:load', function(){
                    @this.on('modelUpdated', (e) => {
                        open = false;
                    });
                });
             </script>
            </div>
        </div>
        @endcan --}}
</div>
