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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
    return $request->admin();
});

Route::get('/comments', function (Request $request) {
    $comments = Comment::with(['user', 'replies.user'])
        ->where('commentable_id', $request->commentable_id)
        ->where('commentable_type', $request->commentable_type)
        ->whereNull('parent_id')
        ->latest()
        ->get();

    return response()->json($comments);
});

Route::post('/comments', function (Request $request) {
    $validated = $request->validate([
        'commentable_id' => 'required|integer',
        'commentable_type' => 'required|string',
        'content' => 'required|min:3',
        'parent_id' => 'nullable|integer|exists:comments,id'
    ]);

    $comment = Comment::create([
        'user_id' => auth()->user()->id,
        'commentable_id' => $validated['commentable_id'],
        'commentable_type' => $validated['commentable_type'],
        'content' => $validated['content'],
        'parent_id' => $validated['parent_id'] ?? null
    ]);

    return response()->json($comment->load('user'));
});
