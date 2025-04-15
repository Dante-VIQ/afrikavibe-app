<?php

namespace App\Livewire;

use App\Models\Header;
use Livewire\Component;
use App\Models\Destination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;

class HeaderCard extends Component
{
    use WithFileUploads;

    public $headers, $header, $name, $category, $header_id, $user;

    #[Validate('image|max:10240')]
    public $image,
        $imageUrl,
        $imagePath;



    public function render()
    {
        $this->headers = Header::latest()->take(1)->get();

        // $this->headers = auth()->user()->headers;
        return view('livewire.header-card');
    }

    // public function placeholder()
    // {
    //     return view('placeholder');
    // }

    public function create(Header $header)
    {
        Gate::authorize('create', $header);
        $validated = $this->validate([
            'name' => 'required',
            'image' => 'image|max:4096',
            'category' => 'required'
        ]);

        if ($this->image) {
            $validated['image'] = $this->image->store('destination', 'public');
        }

        $imagePath = $this->imageUrl;

        auth()->user()->headers()->create($validated);

        $this->resetFields();

        session()->flash('success', 'Successfully posted');
    }

    public function edittingHeaderID($id)
    {
        $header = Header::findorFail($id);
        $this->name = $header->name;
        $this->image = $header->image;
        $this->header_id = $id;
    }

    public function updateHeader(Header $header)
    {
        Gate::authorize('update', $header);
        $validated = $this->validate([
            'name' => 'alpha|required|',
            'image' => 'image|max:4096',
            'category' => 'alpha|required'
        ]);

        if ($this->image) {
            $validated['image'] = $this->images->store('image', 'public');
        }

        $doctor = Header::find($this->header_id);
        $doctor->update($validated);

        $this->resetFields();
    }

    public function deleteHeader(Header $header)
    {
        Gate::authorize('delete', $header);
        Header::find($id)->delete();
    }

    private function resetFields()
    {
        $this->name = '';
        $this->category = '';
        $this->image = '';
        $this->header_id = null;
    }
}
