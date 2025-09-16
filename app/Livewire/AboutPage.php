<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('guest.app')]
class AboutPage extends Component
{
public $abouts, $about;
    public function render()
    {
         $this->abouts = About::latest()->take(1)->get();
        return view('livewire.about-page');
    }
}
