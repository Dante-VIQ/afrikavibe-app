<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BookingApiService;

class BookingController extends Controller
{
    protected $svc;
    public function __construct(BookingApiService $svc) {
        $this->svc = $svc;
    }

    /**
     * /api/search?query=Nairobi&type=locations|hotels
     */
    public function search(Request $request)
    {
        $q = $request->query('query');
        $type = $request->query('type','locations');

        if (!$q) return response()->json(['error' => 'query required'], 422);

        if ($type === 'locations') {
            $results = $this->svc->searchLocations($q);
            return response()->json($results);
        }

        // hotels
        // attempt to resolve a dest id first
        $locations = $this->svc->searchLocations($q);
        $destId = $locations[0]['dest_id'] ?? null;
        $hotels = $this->svc->searchHotelsByDestination($destId, $q);
        return response()->json($hotels);
    }
}
