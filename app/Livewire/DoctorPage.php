<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\TrackableViews;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class DoctorPage extends Component
{
use TrackableViews;
    public $user, $user_id;
    
    public $doctors, $doctor_id;

    public Doctor $doctor;

    #[Computed()]
    public function doctors(){
        $this->doctors = Doctor::latest()->get();
        
    }
    public function render()
    {
        $this->doctors = Doctor::latest()->get();
        return view('livewire.doctor-page');
    }
}
