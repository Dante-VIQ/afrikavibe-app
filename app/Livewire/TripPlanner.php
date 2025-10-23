<?php
namespace App\Livewire;

use Livewire\Component;
use App\Services\BookingApiService;

class TripPlanner extends Component
{
    public $query = '';
    public $type = ''; // culture, cuisine, beach
    public $budget = '';

    protected $rules = [
        'query' => 'nullable|string|max:255',
    ];

    public function search()
    {
        $this->validate();
        return redirect()->route('trip.results', ['q' => $this->query, 'type' => $this->type, 'budget' => $this->budget]);
    }

    public function render()
    {
        return view('livewire.trip-planner');
    }
}
