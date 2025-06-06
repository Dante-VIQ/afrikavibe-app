<?php

namespace App\Livewire;

use App\Models\Header;
use Livewire\Component;

class HeaderPage extends Component
{
    public $headers, $user, $user_id;

    public Header $header;
    public function render()
    {
        $this->headers = Header::latest()->take(1)->get();

        return view('livewire.header-page');
    }
}
