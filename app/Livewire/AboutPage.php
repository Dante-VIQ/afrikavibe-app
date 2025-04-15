<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Cosite')]
class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.about-page');
    }
}
