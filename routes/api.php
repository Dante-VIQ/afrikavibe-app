<?php

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Get current user (for avatar, etc.)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();
    return response()->json([
        'id' => $user?->id,
        'name' => $user?->name,
        'email' => $user?->email,
        'avatar_url' => $user?->avatar_url ?? null
    ]);
});

// Get comments for a commentable
Route::get('/comments', function (Request $request) {
    $request->validate([
        'commentable_id' => 'required|integer',
        'commentable_type' => 'required|string'
    ]);

    $comments = App\Models\Comment::with([
        'user',
        'replies.user',
        'replies.upvotes',
        'upvotes'
    ])
    ->withCount(['upvotes', 'replies'])
    ->where('commentable_id', $request->commentable_id)
    ->where('commentable_type', $request->commentable_type)
    ->whereNull('parent_id')
    ->latest()
    ->get();

    return response()->json($comments);
});

// Create a new comment
Route::middleware('auth:sanctum')->post('/comments', function (Request $request) {
    $validated = $request->validate([
        'commentable_id' => 'required|integer',
        'commentable_type' => 'required|string',
        'content' => 'required|min:3|max:1000',
        'parent_id' => 'nullable|integer|exists:comments,id'
    ]);

    $comment = App\Models\Comment::create([
        'user_id' => $request->user()->id,
        'commentable_id' => $validated['commentable_id'],
        'commentable_type' => $validated['commentable_type'],
        'content' => $validated['content'],
        'parent_id' => $validated['parent_id'] ?? null
    ]);

    return response()->json($comment->load('user'));
});

// Upvote a comment
Route::middleware('auth:sanctum')->post('/comments/{comment}/upvote', function ($commentId, Request $request) {
    $user = $request->user();
    $comment = App\Models\Comment::findOrFail($commentId);
    $upvote = $comment->upvotes()->where('user_id', $user->id)->first();
    if ($upvote) {
        $upvote->delete();
        $status = 'removed';
    } else {
        $comment->upvotes()->create(['user_id' => $user->id]);
        $status = 'added';
    }
    return response()->json(['status' => $status, 'upvotes' => $comment->upvotes()->count()]);
});

// Delete a comment (optional, for moderation)
Route::middleware('auth:sanctum')->delete('/comments/{comment}', function ($commentId, Request $request) {
    $comment = App\Models\Comment::findOrFail($commentId);
    if ($comment->user_id !== $request->user()->id) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }
    $comment->delete();
    return response()->json(['status' => 'deleted']);
});