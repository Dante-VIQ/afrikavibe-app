<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HeaderMedia;

class HeaderMediaFeed extends Component
{
    public $headerMedia = [];

    // public HeaderMedia $headerMedia;
    public $headerMedias, $user, $user_id;


    public function mount()
    {
  
        $this->headerMedia = HeaderMedia::latest()->take(10)->get();
     
    }

 
    public function render()
    {
        $this->headerMedia = HeaderMedia::latest()->take(10)->get();

        return view('livewire.header-media-feed');
    }
}
