<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Destination.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Destination.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'department' => 'required',
            'detail' => 'required',
            'links' => 'required',
            'image' => 'nullable|sometimes|image:1024',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        auth()->user()->doctors()->create($validated);

        // $this->resetFields();

        session()->flash('success', 'Successfully posted');
        // return redirect('/admin/dashboard')->with('message', 'Blog created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        return view('Blog.edit', ['blog' => $doctor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
            // Make sure logged in user is owner
            if ($doctor->user_id != auth()->id()) {
                abort(403, 'Unauthorized Action');
            }

            $formFields = $request->validate([
                'title' => 'required',
                'company' => ['required'],
                'location' => 'required',
                'website' => 'required',
                'email' => ['required', 'email'],
                'tags' => 'required',
                'description' => 'required'
            ]);

            if ($request->hasFile('image')) {
                $formFields['image'] = $request->file('image')->store('images', 'public');
            }

            $doctor->update($formFields);

            return back()->with('message', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
         // Make sure logged in user is owner
         if ($doctor->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        if ($doctor->image && Storage::disk('public')->exists($doctor->limage)) {
            Storage::disk('public')->delete($doctor->image);
        }
        $doctor->delete();
        return redirect('/')->with('message', 'Blog deleted successfully');
    }
}
