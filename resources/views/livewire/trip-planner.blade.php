<div class="p-6 bg-white rounded shadow">
  <form wire:submit.prevent="search" class="flex gap-2">
    <input wire:model.defer="query" type="text" placeholder="Country, city or type (e.g., beach or culture)" class="flex-1 p-3 border rounded" />
    <select wire:model.defer="type" class="p-3 border rounded">
      <option value="">Any</option>
      <option value="culture">Culture</option>
      <option value="cuisine">Cuisine</option>
      <option value="adventure">Adventure</option>
    </select>
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Plan My Trip</button>
  </form>
</div>
