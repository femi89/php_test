<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;

class UserCommentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $comments = $user
            ->comments()
            ->search($search)
            ->latest()
            ->paginate();

        return new CommentCollection($comments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validate([
            'article_id' => ['nullable', 'exists:articles,id'],
            'message' => ['nullable', 'max:255', 'string'],
            'isGuest' => ['nullable', 'boolean'],
            'guest_name' => ['nullable', 'max:255', 'string'],
        ]);

        $comment = $user->comments()->create($validated);

        return new CommentResource($comment);
    }
}
