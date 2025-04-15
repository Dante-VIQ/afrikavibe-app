<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

#[Layout('layouts.app')]
class BlogPage extends Component
{
    public $blogs, $user, $blog_id;

    public Blog $blog;

    #[Computed]
    public function blogs()
    {
        return Blog::latest()
            ->filter(request(['like',  'search']))
            ->get();
    }

    // public function mount($blogID)
    // {
    //     return view('livewire.blog-page')
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
        $this->blogs = Blog::All();
        return view('livewire.blog-page');
    }
}
