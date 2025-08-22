<?php

namespace App\Livewire;

use App\Models\Upvote;
use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class CommentModal extends Component
{
    public $commentableId;
    public $commentableType;
    public $content = '';
    public $parentId = null;
    public $showModal = false;

    #[On('open-comment-modal')]
    public function openCommentModal($commentableId, $commentableType)
    {
        $this->commentableId = $commentableId;
        $this->commentableType = $commentableType;
        $this->showModal = true;
        $this->reset(['content', 'parentId']);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['content', 'parentId', 'commentableId', 'commentableType']);
    }

    protected $rules = [
        'content' => 'required|min:3|max:1000'
    ];

    public function save()
    {
        $this->validate();

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Comment::create([
            'user_id' => Auth::id(),
            'commentable_id' => $this->commentableId,
            'commentable_type' => $this->commentableType,
            'content' => $this->content,
            'parent_id' => $this->parentId
        ]);

        // Reset form and notify
        $this->reset(['content', 'parentId']);
        $this->dispatch('comment-added');
        
        // Optional: Show success message
        session()->flash('message', 'Comment posted successfully!');
    }

    public function reply($commentId)
    {
        $this->parentId = $commentId;
        $this->dispatch('focus-comment-input');
    }

    public function cancelReply()
    {
        $this->reset('parentId');
    }

    public function upvote($commentId)
    {
        if (!Auth::check()) return;

        $comment = Comment::findOrFail($commentId);

        // Toggle upvote
        $upvote = $comment->upvotes()->where('user_id', Auth::id())->first();

        if ($upvote) {
            $upvote->delete();
        } else {
            Upvote::create([
                'user_id' => Auth::id(),
                'comment_id' => $commentId
            ]);
        }

        // Refresh the component to show updated counts
        $this->dispatch('comment-upvoted');
    }

    public function getCommentsProperty()
    {
        if (!$this->commentableId || !$this->commentableType) {
            return collect();
        }

        return Comment::with([
                'user', 
                'replies.user', 
                'replies.upvotes',
                'upvotes'
            ])
            ->withCount(['upvotes', 'replies'])
            ->where('commentable_id', $this->commentableId)
            ->where('commentable_type', $this->commentableType)
            ->whereNull('parent_id')
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.comment-modal', [
            'comments' => $this->comments
        ]);
    }
}