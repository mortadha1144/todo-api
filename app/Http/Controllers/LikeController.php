<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Resources\MessageResource;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Toggle like for a post - create if not exists, delete if exists.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        // Check if the user already liked this post
        $existingLike = $request->user()->likes()->where('post_id', $validated['post_id'])->first();

        if ($existingLike) {
            // User already liked this post, so unlike it (delete the like)
            $existingLike->delete();
            return new MessageResource('Like removed successfully', 200);
        }

        // User hasn't liked this post yet, so create a new like
        $request->user()->likes()->create($validated);
        return new MessageResource('Like created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}
