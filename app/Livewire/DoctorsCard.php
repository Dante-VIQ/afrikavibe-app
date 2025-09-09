<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\TrackableViews;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Laravel\Scout\Searchable;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

#[Layout('layouts.art')]
class DoctorsCard extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $doctors, $doctor, $doctor_id, $user;

    public $name, $NewName;

    public $department, $NewDepartment;

    public $editingDoctorID;

    public $links, $NewLinks;

    public $detail, $NewDetail;

    #[Validate('image|max:10240')]
    #[Validate('image|max:10240')]
    #[Validate('image|max:10240')]
    #[Validate('image|max:10240')]
    #[Validate('image|max:10240')]
    public $media,
        $media_type,
        $NewImage,
        $image_path,
        $imageUrl;

    protected $rules = [
        'name' => 'required',
        'department' => 'required',
        'links' => 'required',
        'detail' => 'required',
        'NewName' => 'required',
        'NewDepartment' => 'required',
        'NewLinks' => 'required',
        'media' => 'required|file|max:10480',
    ];
    #[Computed]
    public function doctors()
    {
        $this->doctors = Doctor::latest()->get();
        return view('eco-destination');
    }

    public function mount()
    {
        $this->doctors = Doctor::latest()->get();

        return view('livewire.doctor-page')->with('doctors', $this->doctors);
    }
    public function render()
    {
        $this->doctors = Doctor::latest()->take(10)->get();

        return view('livewire.doctors-card');
    }

    // public function placeholder()
    // {
    //     return view('placeholder');
    // }
    public function create()
    {
        $validated = $this->validate([
            'name' => 'required',
            'department' => 'required',
            'detail' => 'required',
            'links' => 'required',
            'media' => 'nullable|sometimes|image:1024',
        ]);

        $mediaPath = null;
        $mediaType = null;
        $filename = null;
        if ($filename) {
            if ($this->media) {
                // Ensure uploads directory exists
                $uploadDir = public_path('destinations');
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $filename = uniqid() . '.' . $this->media->getClientOriginalExtension();
                $media = $uploadDir . '/' . $filename;

                // Get the temporary file path from Livewire
                $tempPath = $this->media->getRealPath();
                ImageOptimizer::optimize($tempPath);
                // Move using PHP's rename function (faster than copy)
                rename($tempPath, $media);

                // Determine media type based on file extension or MIME type
                $extension = strtolower($this->media->getClientOriginalExtension());
                $mediaType = $this->getMediaType($extension);

                $validated['media_path'] = 'destinations/' . $filename;
                $validated['media_type'] = $mediaType;
            } else {
                $validated['media'] = null;
            }
        }

        $validated['user_id'] = Auth::id();
        $validated['image_path'] = 'destinations/' . $filename;
        $validated['media_type'] = $mediaType;
        auth()->user()->doctors()->create($validated);

        $this->resetFields();
        session()->flash('success', 'Header post created successfully!');
        $this->dispatch('headerMediaPosted');

        session()->flash('success', 'Successfully posted');
    }

    public function edit($doctorID)
    {
        Gate::authorize('update', Doctor::class);

        $this->editingDoctorID = $doctorID;
        $this->NewName = Doctor::FindorFail($doctorID)->name;
        $this->NewDepartment = Doctor::FindorFail($doctorID)->department;
        $this->NewDetail = Doctor::FindorFail($doctorID)->detail;
        $this->NewLinks = Doctor::FindorFail($doctorID)->links;
        $this->NewImage = Doctor::FindorFail($doctorID)->image;
        // $this->doctor_id = $id;
    }
    // cancel edit formfields
    public function cancelEdit()
    {
        $this->reset('editingDoctorID', 'NewName', 'NewDepartment', 'NewDetail', 'NewLinks', 'NewImage');
    }

    // Update Listing Data
    public function update(Doctor $doctor)
    {
        Gate::authorize('update', Doctor::class);

        $validated = $this->validate([
            'NewName' => 'required',
            'NewDepartment' => 'required',
            'NewDetail' => 'required',
            'NewLinks' => 'required',
            'NewImage' => 'nullable|sometimes|image:1024',
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

        Doctor::FindorFail($this->editingDoctorID)->update([
            'name' => $this->NewName,
            'department' => $this->NewDepartment,
            'image' => $this->NewImage,
            'links' => $this->NewLinks,
            'detail' => $this->NewDetail,
        ]);

        return back()->with('message', 'Destination updated successfully!');
    }

    public function delete($id)
    {
        Gate::authorize('delete', Doctor::class);
        Doctor::findorFail($id)->delete();
        return back()->with('message', 'Destination deleted successfully');
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

    private function resetFields()
    {
        $this->name = '';
        $this->department = '';
        $this->detail = '';
        $this->links = '';
        $this->media = '';
        $this->doctor_id = null;
    }
}
