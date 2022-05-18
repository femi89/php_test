<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;

class ArticleCommentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Article $article)
    {
        $this->authorize('view', $article);

        $search = $request->get('search', '');

        $comments = $article
            ->comments()
            ->search($search)
            ->latest()
            ->paginate();

        return new CommentCollection($comments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
            'message' => ['nullable', 'max:255', 'string'],
            'isGuest' => ['nullable', 'boolean'],
            'guest_name' => ['nullable', 'max:255', 'string'],
        ]);

        $comment = $article->comments()->create($validated);

        return new CommentResource($comment);
    }
}
