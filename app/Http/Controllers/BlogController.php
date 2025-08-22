<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\TrackableViews;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Middleware\TrackContentView;
use App\Models\User;

class BlogController extends Controller
{
    use TrackableViews;

    public function __construct()
    {
        $this->authorize(Blog::class, 'blog');

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image|sometimes|nullable|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        // $imagePath = $this->imageUrl;
        //    auth()->user()->blogs()->create($validated);

        Blog::create($validated);
        $this->resetFields();

        return redirect('/Analysis')->with('message', 'Blog created successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }

}
