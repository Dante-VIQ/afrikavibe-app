<?php

namespace App\Livewire;

use App\Models\Blog;
use App\TrackableViews;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

#[Layout('layouts.app')]
class BlogPage extends Component
{
    use Commentable;
    use TrackableViews;
    public $blogs, $user, $blog_id;

    public Blog $blog;

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

    //Show single blog
    public function show(Blog $blog)
    {
        return view('blog-lay', [
            'blog' => $blog,
        ]);
    }

    public function render()
    {
        $this->blogs = Blog::latest()->get();
        return view('livewire.blog-page');
    }
}
