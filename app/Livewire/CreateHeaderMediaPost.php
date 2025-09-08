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
            // Ensure uploads directory exists
            $uploadDir = public_path('headers');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filename = uniqid() . '.' . $this->media->getClientOriginalExtension();
            $media = $uploadDir . '/' . $filename;

            // Get the temporary file path from Livewire
            $tempPath = $this->media->getRealPath();

            // Move using PHP's rename function (faster than copy)
            rename($tempPath, $media);

            // Determine media type based on file extension or MIME type
            $extension = strtolower($this->media->getClientOriginalExtension());
            $mediaType = $this->getMediaType($extension);

            $validated['media_path'] = 'headers/' . $filename;
            $validated['media_type'] = $mediaType;
        } else {
            $validated['media'] = null;
        }

        $validated['user_id'] = Auth::id();
        $validated['image_path'] = 'headers/' . $filename;
        $validated['media_type'] = $mediaType;

        HeaderMedia::create($validated);

        $this->resetForm();
        session()->flash('success', 'Header post created successfully!');
        $this->dispatch('headerMediaPosted');
    }

    private function getMediaType($extension)
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        $videoExtensions = ['mp4', 'mov', 'avi', 'wmv', 'flv', 'webm', 'mkv'];

        if (in_array($extension, $imageExtensions)) {
            return 'image';
        } elseif (in_array($extension, $videoExtensions)) {
            return 'video';
        } else {
            return 'other'; // or throw an exception
        }
    }

    private function resetForm()
    {
        $this->reset(['title', 'body', 'media', 'location']);
    }

    public function render()
    {
        return view('livewire.create-header-media-post');
    }
}
