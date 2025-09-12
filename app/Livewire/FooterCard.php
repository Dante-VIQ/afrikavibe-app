<?php

namespace App\Livewire;

use App\Models\Doctor;
use Livewire\Component;

class FooterCard extends Component
{

    public $doctors, $name;
    public function render()
    {
        $this->doctors = Doctor::latest()->take(6)->get();
        return view('livewire.footer-card');
    }
}
