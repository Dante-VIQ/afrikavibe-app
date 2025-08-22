<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\Doctor;
use App\Models\Header;
use App\Models\Culture;
use Livewire\Component;
use App\Models\HeaderMedia;
use Livewire\Attributes\Computed;

class HeaderPage extends Component
{
    public $headers, $user, $user_id;

    public Header $header;

    public $cultures, $culture;

    public $doctors, $doctor;

    public $blogs, $blog;

      public $mediaItems = [];

    public function mount()
    {
        // random order for freshness; change to ->latest() if you prefer chronological
        $this->mediaItems = HeaderMedia::inRandomOrder()->take(12)->get();
    }
    public function cultures(){
        // $this->blogs = Blog::latest()->get();
        // $this->doctors = Doctor::latest()->get();
        $this->cultures = Culture::latest()->get();
    }

    public function doctors(){
        $this->doctors = Doctor::latest()->get();
    }

    public function blogs() {
        $this->blogs = Blog::latest()->get();
    }
    public function render()
    {
        $this->headers = Header::latest()->take(1)->get();
        return view('livewire.header-page');
    }
}
