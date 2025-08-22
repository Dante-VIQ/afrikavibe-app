<?php

namespace App\Livewire;

use App\Models\Blog;
use App\TrackableViews;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use App\Models\UserActivityLog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

#[Layout('layouts.app')]
class BlogPage extends Component
{
  
    use TrackableViews;
    public $blogs, $user, $blog_id;

    public Blog $blog;

    public $filter = null;

    public function mount($category = null) 
    {
        $this->filter = $category;
    }

    public function setFilter($category)
    {
        $this->filter = $category;

        $url = $category ? route('blog.category', $category) : route('main');

        $this->dispatch('pushState', [
            'url' => $url,
            'title' => ucfirst($category ?? 'Blog'),
        ]);
    }
    #[Computed()]
    public function blogs()
    {
        return Blog::latest()
            ->filter(request(['like',  'search']))
            ->get();
    }

    // #[Computed()]
    // public function mount()
    // {
    //     return view('yutpo')
    //     ->with('blog', Blog::findOrFail($blogID));
    // }

    // #[Computed()]
    // public function show(Blog $blog)
    // {
    //     UserActivityLog::log(
    //         action: 'view_blog',
    //         description: "Viewed blog: {$blog->title}",
    //         metadata: [
    //             'blog_id' =>$blog->id,
    //             'category' => $blog->category
    //         ]
    //         );

    //     return view('blog-lay')->with('blog', compact('blog'));
    // }
    //Show single blog

    public function render()
    {
        // $this->blogs = Blog::latest()->get();
        $this->blogs = Blog::when($this->filter, fn($q) => $q->where('category', $this->filter))->take(3)->get();
        return view('livewire.blog-page');
    }
}
