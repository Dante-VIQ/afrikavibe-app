<?php

namespace App\Livewire;

use App\Models\Doctor;
use Livewire\Component;
use App\Livewire\DoctorsCard;
use App\Models\Culture;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.art')]
class ManageLink extends Component
{

    public $doctors, $user, $doctor_id;

    public $cultures, $culture_id;

    public Doctor $doctor;

    public Culture $culture;
    #[Computed()]
    public function doctors(){
        $this->doctors = Doctor::latest()->get();
    }

    #[Computed()]
    public function cultures(){
        return Culture::latest()->get();
    }

    public function render()
    {
        $this->doctors = Doctor::latest()->get();
        return view('livewire.manage-link');
    }
}
