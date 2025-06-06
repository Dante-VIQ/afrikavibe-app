<?php

namespace App\Livewire;

use DB;
use Carbon\Carbon;
use App\Models\Blog;
use App\TrackableViews;
use Livewire\Component;
use App\Models\Activity;
use App\Events\UserActivity;
use Laravel\Scout\Searchable;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Middleware\Authorize;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

#[Title('layouts.art')]
class BlogCard extends Component
{
    use WithFileUploads;
    use Commentable;
    use Searchable;


    public $title, $user;
    public $blogs, $blog, $blog_id;
    public $NewTitle;
    public $NewDescription;
    public $NewImage;
    public $editingBlogID;
    #[Rule('required|min:3|max:2000')]
    public $description;

    public $category, $NewCategory;

    #[Validate(['image' => 'image|max:10240'])]
    public $image;

    // public function placeholder()
    // {
    //     return view('placeholder');
    // }

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'image' => 'image|sometimes|nullable|max:10240',
        'category' => 'required',
        'NewTitle' => 'required',
        'NewDescription' => 'required',
        'NewImage' => 'image|sometimes|nullable|max:10240',
        'NewCategory' => 'required',
    ];

    #[Computed()]
    public function blogs() {
        $this->blogs = Blog::latest()->get();
    }

    // create a blog
    public function create(Blog $blog)
    {
        Gate::authorize('create', $blog);
        $validated = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image|sometimes|nullable|max:10240',
        ]);

        if ($this->image) {
            $validated['image'] = $this->image->store('images', 'public');
        }

        //  foreach($this->images as $image) {
        //  $validated['images'] = $image->store('images', 'public');
        // }
        // $imagePath = $this->imageUrl;

        auth()->user()->blogs()->create($validated);

        $this->resetFields();

        session()->flash('success', 'Successfully posted');
    }

    // edit blog
    public function edit($blogID)
    {
        Gate::authorize('update', Blog::class);
        $this->editingBlogID = $blogID;
        $this->NewTitle = Blog::findorFail($blogID)->title;
        $this->NewDescription = Blog::findorFail($blogID)->description;
        $this->NewCategory = Blog::findorFail($blogID)->category;
        $this->NewImage = Blog::findorFail($blogID)->image;
    }

    // update blog
    public function update(Request $request, Blog $blog)
    {

        Gate::authorize('update', Blog::class);
        $validated = $this->validate([
            'NewTitle' => 'required',
            'NewDescription' => 'required',
            // 'image' => 'image|sometimes|nullable|max:10240',
        ]);

        if ($this->image) {
            $validated['NewImage'] = $this->image->store('images', 'public');
        }
        //    $imagePath = $this->imageUrl;

        Blog::FindorFail($this->editingBlogID)->update([
            'title' => $this->NewTitle,
            'merit' => $this->NewMerit,
            'image' => $this->NewImage,
            'photo' => $this->NewPhoto,
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

        event(new UserActivity(
            $request->user(),
            'blog_updated',
            "Updated Blog {$blog->title}",
            $request,
            ['blog_id' => $blog->id]
        ));
    }

    // delete blog
    public function destroy(Blog $blog)
    {
        Gate::authorize('delete', $blog);
        $blog->delete();

        return to_route('dashboard');
    }

    public function render()
    {
        // $this->blogs = Blog::latest()
        //     ->take(4)
        //     ->filter(request(['title', 'search']))
        //     ->get();
        $this->blogs = Blog::latest()
        ->take(4)
        ->get()
        ->map(function ($blog) {
            $blog->timeframe = $blog->created_at->diffForHumans();
            return $blog;
        });
        return view('livewire.blog-card');
    }

    //  Show single blog
    #[Computed]
    public function show($blogID)
    {
        return view('yutpo')->with('blog', Blog::findOrFail($blogID));
    }

    private function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->category = '';
        $this->image = '';
        $this->blog_id = null;
    }

    public function mount(Blog $blog)
    {

        $this->blog = $blog;
        Activity::updateOrCreate(
            [
                'page_type' => 'blog',
                'page_id' => $blog->id,
                'date' => now()->toDateString(),
            ],
            ['view_count' => DB::raw('view_count + 1')],
        );
    }
}
