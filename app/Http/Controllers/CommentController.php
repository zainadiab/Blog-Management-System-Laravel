<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment_text' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id();
    $comment->comment_text = $request->comment_text;
        $comment->save();

        // Load the user relation for the comment
        $comment->load('user');

        if ($request->ajax()) {
            // Return JSON response with new comment data
            return response()->json([
                'id' => $comment->id,
                'user_name' => $comment->user ? $comment->user->name : 'Anonymous',
                'comment_text' => $comment->comment_text,
                'created_at' => $comment->created_at->diffForHumans(),
            ]);
        }

        // For normal requests, redirect back
        return redirect()->back()->with('success', 'Comment added!');
    }
}
