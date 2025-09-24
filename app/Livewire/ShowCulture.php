<?php

namespace App\Livewire;

use App\Models\Culture;
use Livewire\Component;

class ShowCulture extends Component
{
          public Culture $culture;

        public function mount(Culture $culture)
    {
        $this->culture = $culture;
    }
    public function render()
    {
        return view('livewire.show-culture');
    }
}
