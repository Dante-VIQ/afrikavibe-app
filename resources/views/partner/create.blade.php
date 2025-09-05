@props(['partner' => null])

<form method="POST" 
      action="{{ $partner ? route('partners.update', $partner) : route('partners.store') }}" 
      enctype="multipart/form-data"
      class="space-y-6">
    @csrf
    @if($partner)
        @method('PUT')
    @endif

    <!-- Name -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Business Name</label>
        <input type="text" name="name" value="{{ old('name', $partner->name ?? '') }}" 
               class="w-full mt-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Logo -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Logo</label>
        <input type="file" name="logo" class="mt-1">
        @if($partner && $partner->logo)
            <img src="{{ asset('storage/'.$partner->logo) }}" 
                 class="w-16 h-16 mt-2 rounded-full object-cover shadow">
        @endif
        @error('logo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Tagline -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Tagline</label>
        <input type="text" name="tagline" value="{{ old('tagline', $partner->tagline ?? '') }}" 
               class="w-full mt-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <!-- Description -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" rows="4"
                  class="w-full mt-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $partner->description ?? '') }}</textarea>
    </div>

    <!-- Website -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Website</label>
        <input type="url" name="website_url" value="{{ old('website_url', $partner->website_url ?? '') }}" 
               class="w-full mt-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <!-- Country -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Country</label>
        <input type="text" name="country" value="{{ old('country', $partner->country ?? '') }}" 
               class="w-full mt-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <!-- Sponsorship Level -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Sponsorship Level</label>
        <select name="sponsorship_level" 
                class="w-full mt-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            @foreach(['basic', 'featured', 'premium'] as $level)
                <option value="{{ $level }}" 
                        {{ old('sponsorship_level', $partner->sponsorship_level ?? 'basic') === $level ? 'selected' : '' }}>
                    {{ ucfirst($level) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Submit -->
    <div>
        <button type="submit" 
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow hover:bg-indigo-700">
            {{ $partner ? 'Update Partner' : 'Create Partner' }}
        </button>
    </div>
</form>
