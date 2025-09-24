<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\Culture;
use App\TrackableViews;
use Livewire\Component;
use App\Models\Comments;
use App\Models\UserActivityLog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Comment;

// #[Layout('layouts.app')]
class DoctorPage extends Component
{
use TrackableViews;
    public $user, $user_id;

    public $doctors, $doctor_id;

    public $doctor;

public $detail;

     public $filter = null;

    // public function mount($category = null)
    // {
    //     $this->filter = $category;
    // }

    public function setFilter($category)
    {
        $this->filter = $category;

        $url = $category ? route('doctor.category', $category) : route('main');

        $this->dispatch('pushState', [
            'url' => $url,
            'title' => ucfirst($category ?? 'Doctor'),
        ]);
    }
    // #[Computed()]
    // public function doctors(){
    //     $this->doctors = Doctor::latest()->get();

    //     // return view('destination')->with('doctors', $this->doctors);

    // }

   
        public function mount(Doctor $doctor)
    {

         $this->doctor = $doctor;
        // return view('Partials.doctor')->with('doctor', compact('doctor'));
    }

    public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}


    public function render()
    {
        $this->doctors = Doctor::latest()->get();
        // $this->doctors = Doctor::when($this->filter, fn($q) => $q->where('category', $this->filter))->take(10)->get();
        return view('livewire.doctor-page');
    }


}
