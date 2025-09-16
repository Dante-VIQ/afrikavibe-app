<?php

namespace App\Livewire;

use App\Models\About;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;

class AboutCard extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $abouts, $about_id, $user;

    public $detail;

    public $about;

    public $title, $NewTitle;

    public $editingAboutID;

    public $NewDetail;

    public $merit, $NewMerit;

    public $image, $NewImage, $imagePath;

    // public $editingNewImage, $editingNewPhoto;

    public $photo, $NewPhoto, $photoPath;

    protected $rules = [
        'detail' => 'required|alpha|max:255',
        'title' => 'required|alpha|max:255',
        'merit' => 'required|alpha|max:255',
        'image' => 'required|image|max:10240',
        'photo' => 'required|image|max:10240',
        'NewDetail' => 'required|alpha|max:255',
        'NewTitle' => 'required|alpha|max:255',
        'NewMerit' => 'required|alpha|max:255',
        'NewImage' => 'required|image|mimes:jpeg,png,gif,svg|max:10480',
        'Newphoto' => 'required|image|mimes:jpeg,png,gif,svg|max:10480',
    ];
    public function render()
    {
        $this->abouts = About::latest()->take(1)->get();

        return view('livewire.about-card');
    }

    //  Show single listing
    public function show($aboutID)
    {
        return view('livewire.includes.about-show')->with('about', About::findOrFail($aboutID));
    }

    public function create(About $about)
    {
        
        $validated = $this->validate([
            'detail' => 'required',
            'title' => 'required',
            'merit' => 'required',
            'image' => 'required',
            'photo' => 'required',
        ]);

        // $imageName = time() .'.'. $this->image->extension();

        if ($this->image) {
            $validated['image'] = $this->image->store('images', 'public');
            // $imagePath = $this->imageUrl;
        }
        // $this->imageName = basename($imagePath);

        // $photoName = time() .'.'. $this->photo->extension();

        if ($this->photo) {
            $validated['photo'] = $this->photo->store('photos', 'public');
            // $photoPath = $this->photoUrl;
        }

        // $photoPath = $this->photo;
        // $this->photoName = basename($photoPath);

        auth()->user()->abouts()->create($validated);

        $this->resetFields();

        session()->flash('success', 'Successfully posted');
        // dd(asset('storage/' . $this->image));
        // dd(asset('storage/' . $this->photo));
    }


    public function edit($aboutID)
    {
        Gate::authorize('update', About::class);

        $this->editingAboutID = $aboutID;
        $this->NewTitle = About::FindorFail($aboutID)->title;
        $this->NewDetail = About::FindorFail($aboutID)->detail;
        $this->NewMerit = About::FindorFail($aboutID)->merit;
        $this->NewImage = About::FindorFail($aboutID)->image;
        $this->NewPhoto = About::FindorFail($aboutID)->photo;
        // $this->About1D = $aboutID;
    }

    public function cancelEdit()
    {
        $this->reset('editingAboutID', 'NewTitle', 'NewDetail', 'NewMerit', 'NewImage', 'NewPhoto');
    }

    public function update(About $about)
    {
        Gate::authorize('update', $about);

        $validated = $this->validate([
            'NewTitle' => 'required',
            'NewDetail' => 'required',
            'NewMerit' => 'required',
            'NewImage' => 'image|max:10240',
            'NewPhoto' => 'image|max:10240',
        ]);

        if ($this->NewImage) {
            $validated['NewImage'] = $this->image->store('images', 'public');
        }

        if ($this->NewPhoto) {
            $validated['NewPhoto'] = $this->photo->store('photos', 'public');
        }
        //    $imagePath = $this->imageUrl;

        // $about->update($validated);

        About::FindorFail($this->editingAboutID)->update([
            'title' => $this->NewTitle,
            'merit' => $this->NewMerit,
            'image' => $this->NewImage,
            'photo' => $this->NewPhoto,
            'detail' => $this->NewDetail,
        ]);
        $this->resetFields();
        $this->cancelEdit();

    }

    public function delete($id)
    {
        Gate::authorize('delete', About::class);

        About::findorFail($id)->delete();
        return back()->with('message', 'About deleted successfully!');

    }

    // public function placeholder() {
    //     return view('placeholder');
    // }

    private function resetFields()
    {
        $this->title = '';
        $this->detail = '';
        $this->image = '';
        $this->photo = '';
        $this->merit = '';
        $this->about_id = null;
    }
}
