<?php

namespace App\Livewire;

use App\Models\Doctor;
use Livewire\Component;

class ShowDoctor extends Component
{
    public Doctor $doctor;
    
        public function mount(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }
    public function render()
    {
        return view('livewire.show-doctor');
    }
}
