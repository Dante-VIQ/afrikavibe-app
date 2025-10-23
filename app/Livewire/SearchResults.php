<?php
namespace App\Livewire;

use App\Models\Partner;
use Livewire\Component;
use App\Models\TripPlan;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\BookingApiService;

class SearchResults extends Component
{
    public $q;
    public $type;
    public $budget;
    public $hotels = [];
    public $partners = [];

    public $query;
    public $results = [];
    protected $listeners = ['refreshResults' => '$refresh'];

    public function mount(Request $request)
    {
        $this->query = $request->query('query');

        if (!$this->query) {
            $this->results = [];
            return;
        }

        $this->loadResults();
    }

    // public function loadResults()
    // {
    //     $booking = app(\App\Services\BookingApiService::class);
    //     $this->results = $booking->searchLocations($this->query);
    // }

    public function loadResults()
    {
        $booking = app(BookingApiService::class);
        $this->results = $booking->searchLocations($this->query);
        // $svc = new BookingApiService();
        // get destinations
        // $locations = $svc->searchLocations($this->q);
        // $destId = $locations[0]['dest_id'] ?? null;

        // $hotelsRaw = $booking->searchHotelsByDestination($destId, $this->q);
        // $rawResults = $hotelsRaw['result'] ?? ($hotelsRaw['hotels'] ?? $hotelsRaw);
        // $mapped = [];

        // foreach (collect($rawResults)->take(25) as $item) {
        //     $mapped[] = $booking->mapHotelItem(is_array($item) ? $item : (array) $item);
        // }

        // $this->hotels = $mapped;

        // // pull partners that match destination name
        // $this->partners = Partner::where('is_active', true)
        //     ->where('destination_name', 'like', "%{$this->q}%")
        //     ->get()
        //     ->toArray();
    }

    /**
     * When a user chooses to "Get Curated Guide" we create a TripPlan and redirect to curated view (gated)
     */
    public function requestGuide($destinationName, $destinationId = null)
    {
        // create a trip plan (no user required for initial step)
        $plan = TripPlan::create([
            'user_id' => auth()->id(),
            'external_destination_name' => $destinationName,
            'external_destination_id' => $destinationId,
            'title' => "{$destinationName} curated guide",
            'preferences' => ['type' => $this->type, 'budget' => $this->budget],
        ]);

        return redirect()->route('curated.show', ['plan' => $plan->id]);
    }

    public function render()
    {
        return view('livewire.search-results');
    }
}
