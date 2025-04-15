 <div class="service-item bg-gray-200 rounded h-100 p-5 wow fadeInUp" data-wow-delay="0.1s">

     <div class="relative mr-4 float-right" x-data="{ show: false }" x-cloak>
         <button x-on:click.prevent="show = true"><i class="fa fa-ellipsis text-3xl"></i></button>

         <div class="absolute right-1 h-auto w-24 bg-primary" x-show="show" x-on:click.outside.prevent="show = false">
             <ol class=" bg-slate-800 text-slate-300 justify-center p-2">
                 @can('update', $service)
                     <div x-data="{ show: false }">
                         <li wire:click="edit({{ $service->id }})"><a href="#" x-on:click.prevent="show = true" >Edit</a></li>
                         {{-- <div class="relative p-5" x-data="{ show: false }"> --}}

                         {{-- <x-button x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                                class="fa fa-add text-primary"></i>
                            Create About</x-button> --}}
                         <div x-show="show" wire:click.outside.prevent="show = false" >
                             @include('livewire.includes.service-edit')
                         </div>

                     </div>
                 @endcan
                 @can('delete', $service)
                     <li wire:click.prevent="delete({{ $service->id }})"><a href="#">Delete Post</a></li>
                 @endcan
             </ol>
         </div>

     </div>

     {{-- <div class="inline-flex  items-center justify-center bg-white rounded-circle mb-4"
         style="width: 65px; height: 65px;">
         <i class="fa fa-heartbeat text-primary fs-2"></i>
     </div> --}}
     <div>

         <h4 class="mb-3 justify-self-start text-xl">{{ $service->title }}</h4>
         <p class="mb-4 text-gray-500">{{ $service->category }}</p>
         {{-- <a class="btn" href=""><i class="fa fa-plus text-primary me-3"></i>Read More</a> --}}
     </div>

 </div>
