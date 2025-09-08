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
use App\Models\UserActivityLog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Middleware\Authorize;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

#[Layout('layouts.art')]
class BlogCard extends Component
{
    use WithFileUploads;
    // use Searchable;


    public $title, $user;
    public $blogs, $blog, $blog_id;
    public $NewTitle;
    public $NewDescription;
    public $NewMedia, $media, $media_type;
    public $editingBlogID;
    #[Rule('required|min:3|max:2000')]
    public $description;

    public $category, $NewCategory;


    // public function placeholder()
    // {
    //     return view('placeholder');
    // }

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'media' => 'required|file|max:10240',
        'category' => 'required',
        'NewTitle' => 'required',
        'NewDescription' => 'required',
        'NewMedia' => 'required|file|max:10240',
        'NewCategory' => 'required',
    ];

    #[Computed()]
    public function blogs() {
        $this->blogs = Blog::latest()->get();
        return view('blogs');
    }

    // create a blog
    public function create(Blog $blog)
    {
        Gate::authorize('create', $blog);
        $validated = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'media' => 'image|sometimes|nullable|max:10240',
        ]);

      if ($this->media) {
            // Ensure uploads directory exists
            $uploadDir = public_path('blogs');
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
            $validated['media_path'] = 'blogs/' . $filename;
          
            $validated['media_type'] = $mediaType;
        } else {
            $validated['media'] = null;
        }

         $validated['user_id'] = Auth::id();
        $validated['image_path'] = 'blogs/' . $filename;
        $validated['media_type'] = $mediaType;
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
        $this->NewMedia = Blog::findorFail($blogID)->image;
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

      if ($this->media) {
            // Ensure uploads directory exists
            $uploadDir = public_path('blogs');
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

            $validated['media_path'] = 'blogs/' . $filename;
            $validated['media_type'] = $mediaType;
        } else {
            $validated['media'] = null;
        }

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
        Gate::authorize('destroy', $blog);
        $blog->delete();

        return to_route('dashboard');
    }



    //  Show single blog
    #[Computed]
    public function show(Blog $blog)
    {
        UserActivityLog::log(
            action: 'view_blog',
            description: "Viewed blog: {$blog->title}",
            metadata: [
                'blog_id' =>$blog->id,
                'category' => $blog->category
            ]
            );

        return view('yutpo')->with('blog', compact('blog'));
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
    private function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->category = '';
        $this->image = '';
        $this->blog_id = null;
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
