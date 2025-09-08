<?php

namespace App\Livewire;

use App\Models\City;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class CityCard extends Component
{
    use WithFileUploads;

    public $city, $cities, $city_id, $user;

    public $name;

    public $country;

    #[Validate(['image' => 'image|max:10240'])]
    public $image;

    protected $rules = [
        'name' => 'required|apha|max:255',
        'country' => 'required|alpha|max:255',
        'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:10480',
    ];

    public function create()
    {
        $validated = $this->validate([
            'name' => 'required',
            'country' => 'required',
            'image' => 'required',
        ]);

        if ($this->image) {
            $uploadDir = public_path('destinations');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filename = uniqid() . '.' . $this->image->getClientOriginalExtension();
            $destination = $uploadDir . '/' . $filename;
            $tempPath = $this->image->getRealPath();
            rename($tempPath, $destination);
            $validated['image'] = 'destinations/' . $filename;
        } else {
            $validated['image'] = null;
        }

    Auth::user()->cities()->create($validated);

        $this->resetFields();

        session()->flash('success', 'Successfully posted');
    }
    public function render()
    {
        $this->cities = City::latest()->get();
        return view('livewire.city-card');
    }

    private function resetFields()
    {
        $this->name = '';
        $this->country = '';
        $this->image = '';
    }
}
