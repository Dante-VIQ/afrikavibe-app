@props(['partner', 'item' => null])

<form method="POST" 
      action="{{ $item ? route('partners.items.update', [$partner, $item]) : route('partners.items.store', $partner) }}" 
      enctype="multipart/form-data"
      class="space-y-6">
    @csrf
    @if($item)
        @method('PUT')
    @endif

    <!-- Name -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Item Name</label>
        <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" 
               class="w-full mt-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Image -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Image</label>
        <input type="file" name="image" class="mt-1">
        @if($item && $item->image)
            <img src="{{ asset('storage/'.$item->image) }}" 
                 class="w-24 h-24 mt-2 rounded-lg object-cover shadow">
        @endif
    </div>

    <!-- Description -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" rows="3"
                  class="w-full mt-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $item->description ?? '') }}</textarea>
    </div>

    <!-- Price -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Price ($)</label>
        <input type="number" name="price" step="0.01" value="{{ old('price', $item->price ?? '') }}" 
               class="w-full mt-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <!-- Submit -->
    <div>
        <button type="submit" 
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow hover:bg-indigo-700">
            {{ $item ? 'Update Item' : 'Add Item' }}
        </button>
    </div>
</form>
