<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HeaderMedia;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class CreateHeaderMediaPost extends Component
{
    use WithFileUploads;
    public $modelClass = HeaderMedia::class;
    // public $showModal = false;
    public $title, $body, $media, $media_type, $location;

    protected $rules = [
        'title' => 'nullable|string|max:255',
        'body' => 'nullable|string',
        'media' => 'nullable|file|max:10240', // 10MB
    ];

    // protected $listeners = ['openPostModal' => 'show'];

    public function show()
    {
        $this->resetForm();
        // $this->showModal = true;
    }
    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'media' => 'required|file|max:10240', // 10MB
            'location' => 'nullable|string|max:255',
        ]);

        $mediaPath = null;
        $mediaType = null;
        if ($this->media) {
            $filename = uniqid() . '.' . $this->media->getClientOriginalExtension();
            $this->media->move(public_path('uploads'), $filename);
            $mediaPath = 'uploads/' . $filename;
            $mime = $this->media->getMimeType();
            $mediaType = ($mime === 'video/mp4') ? 'video' : 'image';
        }

        $validated['user_id'] = Auth::id();
        $validated['media_path'] = $mediaPath;
        $validated['media_type'] = $mediaType;

        HeaderMedia::create($validated);

        $this->reset(['title', 'body', 'media', 'location']);
        session()->flash('success', 'Header post created successfully!');
        $this->dispatch('headerMediaPosted');
    }

    public function render()
    {
        return view('livewire.create-header-media-post');
    }
}
