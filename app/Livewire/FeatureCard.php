<?php

namespace App\Livewire;

use App\Models\Feature;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class FeatureCard extends Component
{
    use WithFileUploads;
    use Commentable;

    public $features, $feature, $feature_id, $user;
   
    #[Rule('required|min:20|max:1000')]
    public $description,
        $NewDescription;

 
    #[Rule('required|min:3|max:255')]
    public $title,
        $NewTitle;

    
    #[Validate(['image' => 'image|max:10240'])]
    public $image,
        $NewImage,
        $imageUrl,
        $imagePath;

    protected $rules = [
        'NewTitle' => 'required',
        'NewDescription' => 'required',
        'NewImage' => 'image|sometimes|nullable|max:10240',
    ];

    public function mount()
    {
        $this->features = Feature::all();
    }

    public function render()
    {
        $this->features = Feature::latest()->get();
        return view('livewire.feature-card');
    }

    // public function placeholder()
    // {
    //     return view('placeholder');
    // }

    public function create(Feature $feature)
    {
        Gate::authorize('create', $feature);

        $validated = $this->validate([
            'title' => 'required',
            'description' => 'required',
            // 'tags' => 'required',
            'image' => 'image|max:4096',
        ]);

        if ($this->image) {
            $validated['image'] = $this->image->store('events', 'public');
        }

        $imagePath = $this->imageUrl;

        auth()->user()->features()->create($validated);

        $this->resetFields();

        session()->flash('success', 'Successfully posted');
    }

    public function edit(Feature $feature)
    {
        Gate::authorize('update', $feature);
        $feature = Feature::findorFail($feature);
        $this->NewTitle = $feature->title;
        $this->NewDescription = $feature->description;
        // $this->tags = $feature->tags;
        $this->NewImage = $feature->image;
        $this->feature_id = $id;
    }

    public function update(Request $request, Feature $feature)
    {
        Gate::authorize('update', $feature);

        $validated = $this->validate([
            'titles' => 'required',
            'description' => 'required',
            // 'tags' => 'required',
            // 'image' => 'image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->images->store('image', 'public');
        }

        $feature = Feature::find($this->feature_id);
        $feature->update($validated);

        $this->resetFields();
        return back()->with('message', 'Event updated successfully!');
    }

    public function delete($id)
    {
        Gate::authorize('update', Feature::class);
        Feature::find($id)->delete();
    }

    private function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->image = '';
        $this->feature_id = null;
    }
}
