<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
    'comment' => 'nullable|string|max:500', // nullable allows empty comments
    'rating'  => 'nullable|integer|min:1|max:5', // allow rating to be optional
]);

        // Ensure at least one field is filled
        if (!$request->comment && !$request->rating) {
            return redirect()->back()->withErrors('Please provide a comment or a rating.');
        }

        Comment::create([
    'product_id' => $productId,
    'user_id' => auth()->id(),
    'comment' => $request->comment, // can be null
    'rating'  => $request->rating ?? 0, // default 0 if not provided
]);

        return redirect()->back()->with('success', 'Your comment/review has been posted!');
    }
}
