<?php

namespace App\Livewire;

use App\Models\Header;
use Livewire\Component;
use App\Models\Destination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;

class DestinationCard extends Component
{

    use WithFileUploads;

    public $destinations;

    public $destination;

    public $name;

    public $detail;

    #[Validate(['images.*' => 'image|max:10240'])]
    public $images, $imagePath, $imageUrl;

    public  $user;

    public $headerID;

    public $destinationID;

    #[Computed()]
    public function destinations(){
        return Destination::all();
    }

    #[Computed()]
    public function headers(){
        return Header::where('destination_id', $this->destinationID);
    }


    public function render()
    {
        $this->destinations = Destination::latest()->take(4)->get();
        return view('livewire.destination-card');
    }

    public function create(Destination $destination)
    {
        Gate::authorize('create', $destination);
        $validated = $this->validate([
            'name' => 'required',
            'detail' => 'required',
            // 'links' => 'required',
            // 'image' => 'image|max:4096',
        ]);

        // if ($this->image) {
        //     $validated['image'] = $this->image->store('images');
        // }


        foreach($this->images as $image) {
         $validated['images'] = $image->store('images', 'public');
        }


        $imagePath = $this->imageUrl;

        auth()->user()->destinations()->create($validated);

        $this->resetFields();

        session()->flash('success', 'Successfully posted');
    }

    // public function destinationID($id)
    // {
    //     $doctor = Doctor::findorFail($id);
    //     $this->name = $doctor->name;
    //     $this->department = $doctor->department;
    //     $this->links = $doctor->links;
    //     $this->image = $doctor->image;
    //     $this->doctor_id = $id;
    // }

    private function resetFields(){
        $this->name = '';
        $this->detail = '';
        $this->images = '';
        $this->destinationID = null;
    }
}
