<?php

namespace App\Livewire;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\Attributes\Computed;

class AppointmentForm extends Component
{

    public $doctors, $doctor;
    public AppointmentForm $form;

    #[Computed()]
    public function doctors(){
        $this->doctors = Doctor::latest()->get();
    }

    public function submitForm(){
        $this->form->validate();

        // send email

        session()->flash('success', 'Appointment Created');

        $this->form->reset();
    }


    public function render()
    {
        return view('livewire.appointment-form');
    }

}
