<?php

namespace App\Livewire;

use App\Models\Culture;
use App\TrackableViews;
use Livewire\Component;

class CulturePage extends Component
{
    use TrackableViews;
    public $cultures, $user, $user_id;

    public Culture $culture;
    
    public function render()
    {
        $this->cultures = Culture::latest()
        ->take(4)
        // ->filter(request(['name', 'search']))
        ->get();
        return view('livewire.culture-page');
    }
}
