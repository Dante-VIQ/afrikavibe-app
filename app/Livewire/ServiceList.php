<?php

namespace App\Livewire;

use Request;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Gate;

class ServiceList extends Component
{
    use WithPagination;
    public $services, $service, $title, $category, $service_id, $user;
    #[Rule('required')]
    public $NewTitle;

    public $editingServiceID;
    #[Rule('required')]
    public $NewCategory;

    protected $rules = [
        'title' => 'required|min:3|max:20',
        'category' => 'required|min:3|max:100',
        'NewTitle' => 'required|min:3|max:20',
        'NewCategory' => 'required|min:3|max:100',
    ];
    public function render()
    {
        // sleep(3);
        // $this->services = auth()->user()->services;
        $this->services = Service::latest()->take(3)->get();

        return view('livewire.service-list');
    }

    // public function placeholder() {
    //     return view('placeholder');
    // }

    public function create()
    {
        Gate::authorize('create', Service::class);
        $validatedData = $this->validate([
            'title' => 'required',
            'category' => 'required',
        ]);

        auth()->user()->services()->create($validatedData);

        $this->resetFields();

        session()->flash('success', 'Successfully posted');
    }

    public function edit($serviceID)
    {
        Gate::authorize('update', Service::class);
        $this->editingServiceID = $serviceID;
        // Make sure logged in user is owner
        // $service = Service::findorFail($id);

        //  if ($service->user_id != auth()->id()) {
        //     abort(403, 'Unauthorized Action');
        // }
        $this->NewTitle = Service::findorFail($serviceID)->title;
        $this->NewCategory = Service::findorFail($serviceID)->category;
        // $this->service_id = $id;
    }

    public function cancelEdit(){
        $this->reset('editingServiceID', 'NewTitle', 'NewCategory');
    }
    public function update()
    {
        Gate::authorize('update', Service::class);

        $this->validate([
            'NewTitle' => 'required',
            'NewCategory' => 'required',
        ]);

        Service::FindorFail($this->editingServiceID)->update([
            'title' => $this->NewTitle,
            'category' => $this->NewCategory,
        ]);
        $this->cancelEdit();


        // return back()->with('message', 'Service updated successfully!');
        // auth()->user()->services()->update($validated);
    }

    public function delete($id)
    {
        Gate::authorize('delete', Service::class);
        Service::findorFail($id)->delete();
        return back()->with('message', 'Service deleted successfully!');
    }

    private function resetFields()
    {
        $this->title = '';
        $this->category = '';
        $this->service_id = null;
    }
}
