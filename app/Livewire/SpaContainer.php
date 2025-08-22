<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

// #[Layout('layouts.app')]
class SpaContainer extends Component
{
    public $page = 'welcome';
    protected $listeners = ['navigateTo'];

    // Set $page from the URL on mount for deep linking
    public function mount()
    {
        $uri = request()->path();
        $allowedPages = ['welcome', 'dashboard', 'destination', 'art', 'blog'];
        // Map URI to page name
        $page = $uri === '/' || $uri === '' ? 'welcome' : $uri;
        $this->page = in_array($page, $allowedPages) ? $page : '404';
    }

    public function navigateTo($page)
    {
        $allowedPages = ['welcome', 'dashboard', 'destination', 'art', 'blog'];
        $this->page = in_array($page, $allowedPages) ? $page : '404';
        // Update browser URL without reload (pushState)
        $url = $page === 'welcome' ? '/' : '/' . $page;
        $this->dispatchBrowserEvent('pushState', [
            'url' => $url,
            'title' => ucfirst($page),
        ]);
    }

    public function render()
    {
        return view('livewire.spa-container');
    }
}
