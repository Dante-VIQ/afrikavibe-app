<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SplashCard extends Component
{
    public $photo;
    public $mask;
    public $title;
    public $caption;
    public $buttonText;
    public $buttonLink;

    public function __construct($photo, $mask, $title, $caption, $buttonText = null, $buttonLink = null)
    {
        $this->photo = $photo;
        $this->mask = $mask;
        $this->title = $title;
        $this->caption = $caption;
        $this->buttonText = $buttonText;
        $this->buttonLink = $buttonLink;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.splash-card');
    }
}
