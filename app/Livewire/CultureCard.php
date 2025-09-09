<?php

namespace App\Livewire;

use App\Models\Culture;
use App\TrackableViews;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;


#[Layout('layouts.art')]
class CultureCard extends Component
{

    use WithFileUploads;
    use TrackableViews;

    public $cultures, $culture, $culture_id, $user;

    public $editingCultureID;

    public $name, $NewName;

    public $location, $NewLocation;

    public $detail, $NewDetail;

    #[Validate('image|sometimes|nullable|max:10240')]
    public $image, $NewImage;

    public $search;

    protected $rules = [
        'name' => 'alpha|min:3|max:50|required',
        'NewName' => 'alpha|min:3|max:50|required',
        'location' => 'required',
        'detail' => 'alpha_num|min:3|required',
        'NewLocation' => 'required',
        'NewDetail' => 'alpha_num|min:3|required',
        'image' => 'image|sometimes|nullable|max:10240',
        'NewImage' => 'image|sometimes|nullable|max:10240',
    ];

    public function render()
    {
        $this->cultures = Culture::latest()
            ->take(4)
            // ->filter(request(['name', 'search']))
            ->get();
        return view('livewire.culture-card');
    }

    public function create(Culture $culture)
    {
        Gate::authorize('create', Culture::class);

        $validated = $this->validate([
            'name' => 'required',
            'location' => 'required',
            'detail' => 'min:3|required',
            // 'image' => 'image|sometimes|nullable|max:10240',
        ]);

        if ($this->image) {
            $uploadDir = public_path('cultures');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filename = uniqid() . '.' . $this->image->getClientOriginalExtension();
            $destination = $uploadDir . '/' . $filename;
            $tempPath = $this->image->getRealPath();
            ImageOptimizer::optimize($tempPath);
            rename($tempPath, $destination);
            $validated['image'] = 'cultures/' . $filename;
            $extension = strtolower($this->image->getClientOriginalExtension());
            $mediaType = $this->getMediaType($extension);
            $validated['media_type'] = $mediaType;
        } else {
            $validated['image'] = null;
            $validated['media_type'] = null;
        }

        $validated['user_id'] = Auth::id();

        auth()->user()->cultures()->create($validated);

        session()->flash('success', 'Created successfully');
        return to_route('dashboard');
    }

    // edit blog
    public function edit($cultureID)
    {
        Gate::authorize('update', Culture::class);
        $this->editingCultureID = $cultureID;
        $this->NewName = Culture::findorFail($cultureID)->name;
        $this->NewDetail = Culture::findorFail($cultureID)->detail;
        $this->NewLocation = Culture::findorFail($cultureID)->location;
    }

    // update blog
    public function update(Culture $culture)
    {
        Gate::authorize('update', Culture::class);
        $validated = $this->validate([
            'name' => 'required',
            'location' => 'required',
            'detail' => 'alpha_num|min:3|required',
            'image' => 'image|sometimes|nullable|max:10240',
        ]);

          if ($this->NewImage) {
            // Ensure uploads directory exists
            $uploadDir = public_path('destinstions');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filename = uniqid() . '.' . $this->image->getClientOriginalExtension();
            $NewImage = $uploadDir . '/' . $filename;

            // Get the temporary file path from Livewire
            $tempPath = $this->NewImage->getRealPath();

            // Move using PHP's rename function (faster than copy)
            rename($tempPath, $NewImage);

            // Determine image type based on file extension or MIME type
            $extension = strtolower($this->NewImage->getClientOriginalExtension());
            $mediaType = $this->getMediaType($extension);

            $validated['media_path'] = 'destinstions/' . $filename;
            $validated['media_type'] = $mediaType;
        } else {
            $validated['NewImage'] = null;
        }
        //    $imagePath = $this->imageUrl;

        Culture::FindorFail($this->editingCultureID)->update([
            'title' => $this->NewTitle,
            'merit' => $this->NewMerit,
            'image' => $this->NewImage,
            // 'photo' => $this->NewPhoto,
            'detail' => $this->NewDetail,
        ]);

        // Blog::Find($this->editingAboutID)->update([
        //     'title' => $this->editingNewTitle,
        //     'merit' => $this->editingNewMerit,
        //     'image' => $this->editingNewImage,
        //     'photo' => $this->editingNewPhoto,
        //     'detail' => $this->editingNewDetail,
        // ]);
        $this->resetFields();
    }

    // delete blog
    public function destroy(Culture $culture)
    {
        Gate::authorize('delete', $culture);
        $culture->delete();

        return to_route('dashboard');
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

}
