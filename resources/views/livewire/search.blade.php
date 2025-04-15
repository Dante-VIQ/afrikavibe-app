<div class="position-relative mx-auto" style="max-width: 300px;">
    <input wire:model="query" class="form-control border-0 w-fit py-3 ps-4 pe-5" type="text"
        placeholder="Ask anthing about Africa">
    <button wire:click.prevent="search" type="button"
        class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2 italic">Ask AI</button>

        <div class="mt-4">
            @foreach($results as $result)
            <div class="p-2 border rounded mb-2">
                {{ $result['title'] }}
            </div>
            @endforeach
        </div>
</div>
