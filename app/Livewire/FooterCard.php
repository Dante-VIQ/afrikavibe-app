<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class FooterCard extends Component
{

    public $services, $title;
    public function render()
    {
        $this->services = Service::latest()->take(6)->get();
        return view('livewire.footer-card');
    }
}
