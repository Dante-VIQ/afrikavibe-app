<?php

namespace App\Livewire;

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
    public $comments = [];
    public $isLoading = false;
    public $error = null;

    #[On('openCommentModal')]
    public function openCommentModal($commentableId, $commentableType)
    {
        $this->commentableId = $commentableId;
        $this->commentableType = $commentableType;
        $this->showModal = true;
        $this->reset(['content', 'parentId', 'error']);
        $this->loadComments();
    }

    public function loadComments()
    {
        if (!$this->commentableId || !$this->commentableType) {
            return;
        }

        $this->isLoading = true;

        try {
            $this->comments = Comment::with(['user', 'replies.user'])
                ->where('commentable_id', $this->commentableId)
                ->where('commentable_type', $this->commentableType)
                ->whereNull('parent_id')
                ->latest()
                ->get();

            $this->isLoading = false;
        } catch (\Exception $e) {
            $this->error = 'Failed to load comments';
            $this->isLoading = false;
        }
    }

    public function save()
    {
        $this->validate([
            'content' => 'required|min:3|max:1000'
        ]);

        if (!Auth::check()) {
            $this->error = 'Please login to comment';
            return;
        }

        try {
            Comment::create([
                'user_id' => Auth::id(),
                'commentable_id' => $this->commentableId,
                'commentable_type' => $this->commentableType,
                'content' => $this->content,
                'parent_id' => $this->parentId
            ]);

            $this->content = '';
            $this->parentId = null;
            $this->error = null;
            $this->loadComments(); // Reload comments

        } catch (\Exception $e) {
            $this->error = 'Failed to post comment';
        }
    }

    public function reply($commentId)
    {
        $this->parentId = $commentId;
        $this->dispatch('reply-started'); // Tell Alpine to focus
    }

    public function cancelReply()
    {
        $this->parentId = null;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['content', 'parentId', 'commentableId', 'commentableType', 'comments', 'error']);
    }

    public function render()
    {
        return view('livewire.comment-modal');
    }
}