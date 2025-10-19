<div class="mt-10 p-4 bg-gray-100 shadow rounded-2xl">
    <h1 class="text-2xl font-bold text-center mb-4">Plan Your Trip</h1>

    <form action="{{ route('search') }}" method="get" class="flex flex-col gap-4">
        <input type="text" name="query" placeholder="Enter city or Destination.." class="border border-gray-600 p-3 rounded-xl"
            required >

        <select name="budject" class="border p-3 rounded-xl">
            <option value="">All Budgets</option>
            <option value="budget">Budget Friendly</option>
            <option value="moderate">Moderate</option>
            <option value="luxury">Luxury</option>

        </select>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-gray-100 font-semibold py-2 px-6 rounded-xl">
            Find Place
        </button>
    </form>
</div>