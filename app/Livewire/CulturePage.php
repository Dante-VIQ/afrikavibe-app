<?php

namespace App\Livewire;

use App\Models\Culture;
use App\TrackableViews;
use Livewire\Component;
use App\Models\UserActivityLog;
use Livewire\Attributes\Computed;

class CulturePage extends Component
{
    use TrackableViews;
    public $cultures, $user, $user_id;

    public Culture $culture;

     public $filter = null;

    public function mount($category = null) 
    {
        $this->filter = $category;
    }

    public function setFilter($category)
    {
        $this->filter = $category;

        $url = $category ? route('culture.category', $category) : route('main');

        $this->dispatch('pushState', [
            'url' => $url,
            'title' => ucfirst($category ?? 'Blog'),
        ]);
    }

     #[Computed()]
    public function cultures()
    {
        return Culture::latest()
            ->filter(request(['like',  'search']))
            ->get();
    }
    public function render()
    {
        // $this->cultures = Culture::latest()
        // ->take(4)
        // // ->filter(request(['name', 'search']))
        // ->get();

         $this->cultures = Culture::when($this->filter, fn($q) => $q->where('category', $this->filter))->take(4)->get();
        return view('livewire.culture-page');
    }

    // #[Computed()]
    // public function show(Culture $culture)
    // {
    //     UserActivityLog::log(
    //         action: 'view_culture',
    //         description: "Viewed culture: {$culture->title}",
    //         metadata: [
    //             'culture_id' =>$culture->id,
    //             'category' => $culture->category
    //         ]
    //         );

    //     return view('art')->with('culture', compact('culture'));
    // }
}
