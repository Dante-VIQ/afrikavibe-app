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

    public function mount($category = null)
    {
        $this->filter = $category;
    }

    public function setFilter($category)
    {
        $this->filter = $category;

        $url = $category ? route('doctor.category', $category) : route('main');

        $this->dispatch('pushState', [
            'url' => $url,
            'title' => ucfirst($category ?? 'Doctor'),
        ]);
    }
    #[Computed()]
    public function doctors(){
        $this->doctors = Doctor::latest()->get();

        // return view('destination')->with('doctors', $this->doctors);

    }

    public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}

public function getFormattedDetailProperty()
    {
        if (!$this->doctor || !$this->doctor->detail) {
            return '';
        }

        // Escape and turn line breaks into <br>
        return nl2br(e($this->doctor->detail));

        // OR if you want paragraphs instead:
        // $text = e($this->doctor->detail);
        // return collect(preg_split("/\n\s*\n/", $text))
        //     ->map(fn($p) => "<p>{$p}</p>")
        //     ->implode('');
    }

    public function render()
    {
        $this->doctors = Doctor::latest()->get();
        // $this->doctors = Doctor::when($this->filter, fn($q) => $q->where('category', $this->filter))->take(10)->get();
        return view('livewire.doctor-page');
    }

    // #[Computed()]
    // public function show(Doctor $doctor)
    // {
    //     UserActivityLog::log(
    //         action: 'view_doctor',
    //         description: "Viewed doctor: {$doctor->title}",
    //         metadata: [
    //             'blog_id' =>$doctor->id,
    //             'category' => $doctor->category
    //         ]
    //         );

    //     return view('destination')->with('doctor', compact('doctor'));
    // }
}
