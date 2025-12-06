<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use App\Models\Cinema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|min:3|max:1000',
            'rating' => 'nullable|integer|between:1,5',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string'
        ]);

        if ($validated['commentable_type'] === 'App\Models\Movie') {
            $commentable = Movie::findOrFail($validated['commentable_id']);
        } elseif ($validated['commentable_type'] === 'App\Models\Cinema') {
            $commentable = Cinema::findOrFail($validated['commentable_id']);
        } else {
            return back()->with('error', 'Invalid comment target');
        }

        $commentData = [
            'content' => $validated['content'],
            'user_id' => Auth::id() ?? 1
        ];
        
        if (isset($validated['rating']) && $validated['rating'] !== null) {
            $commentData['rating'] = $validated['rating'];
        }

        $comment = new Comment($commentData);
        $commentable->comments()->save($comment);

        return back()->with('success', 'Comment added successfully');
    }

    public function destroy(Comment $comment)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        
        if ($userId != $comment->user_id && $userRole !== 'admin') {
            return back()->with('error', 'Unauthorized action');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');
    }

    public function getComments(Request $request)
    {
        $request->validate([
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string'
        ]);

        if ($request->commentable_type === 'App\Models\Movie') {
            $commentable = Movie::with(['comments.user'])->findOrFail($request->commentable_id);
        } else {
            $commentable = Cinema::with(['comments.user'])->findOrFail($request->commentable_id);
        }

        return response()->json([
            'comments' => $commentable->comments,
            'average_rating' => $commentable->comments()->avg('rating')
        ]);
    }
}
