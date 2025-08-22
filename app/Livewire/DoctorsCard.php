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
    public $image, $NewImage, $imagePath, $imageUrl;

    protected $rules = [
        'name' => 'required',
        'department' => 'required',
        'links' => 'required',
        'detail' => 'required',
        'NewName' => 'required',
        'NewDepartment' => 'required',
        'NewLinks' => 'required',
        'image' => 'nullable|sometimes|image:1024',
    ];
    #[Computed()]
    public function doctors(){
        $this->doctors = Doctor::latest()->get();
        return view('eco-destination');
    }

    public function render()
    {
        $this->doctors = Doctor::latest()->take(4)->get();

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
            'image' => 'nullable|sometimes|image:1024',
        ]);

        if ($this->image) {
            $validated['image'] = $this->image->store('images', 'public');
        }

        $imagePath = $this->imageUrl;

        auth()->user()->doctors()->create($validated);

        $this->resetFields();

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
            'NewName'  => 'required',
            'NewDepartment' => 'required',
            'NewDetail' => 'required',
            'NewLinks' => 'required',
            'NewImage' => 'nullable|sometimes|image:1024',
        ]);

        if ($this->NewImage) {
            $validated['NewImage'] = $this->image->store('images', 'public');
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

    private function resetFields()
    {
        $this->name = '';
        $this->department = '';
        $this->detail = '';
        $this->links = '';
        $this->image = '';
        $this->doctor_id = null;
    }
}
