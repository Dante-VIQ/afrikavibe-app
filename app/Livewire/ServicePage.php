<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\ServiceList;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ServicePage extends Component
{

public function placeholder() {
    return view('placeholder');
}

    public function render()
    {
        
        return view('livewire.service-page');
    }

}
