<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Request;

class TestimonialCard extends Component
{

    use WithFileUploads;
    public $testimonials, $testimonial, $name, $profession, $remark, $image, $testimonial_id, $user;

    public function render()
    {
        $this->testimonials = Testimonial::latest()->get();

        return view('livewire.testimonial-card');
    }

    // public function placeholder() {
    //     return view('placeholder');
    // }

    public function create()
    {
         $validated = $this->validate([
            'name' => 'required',
            'profession' => 'required',
            'remark' => 'required',
            // 'image' => 'nullable|sometimes|image|max:1024',
         ]);

         if($this->image) {
            $validated['image'] = $this->image->store('images');
          }

        auth()->user()->testimonials()->create($validated);

        $this->resetFields();

        session()->flash('success', 'Successfully posted');
    }

    public function edit($id){
        $testimonial = Testimonial::findorFail($id);
        $this->name = $testimonial->name;
        $this->profession = $testimonial->profession;
        $this->remark = $testimonial->remarks;
        $this->image = $testimonial->image;
        $this->testimonial_id = $id;
    }

    // Update Listing Data
    public function update(Request $request, Testimonial $testimonial)
    {
        // Make sure logged in user is owner
        if ($testimonial->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $validated = $this->validate([
            'name' => 'required',
            'profession' => 'required',
            'remark' => 'required',
            'image' => 'nullable|sometimes|image|max:1024',
         ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $testimonial->update($validated);

        return back()->with('message', 'Testimonial updated successfully!');
    }

    public function deleteTestimonial($id) {
        Testimonial::find($id)->delete();
    }

    private function resetFields(){
        $this->name = '';
        $this->profession = '';
        $this->remark = '';
        $this->image = '';
        $this->testimonial_id = null;
    }
}


