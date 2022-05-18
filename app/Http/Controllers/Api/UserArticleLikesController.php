<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleLikeResource;
use App\Http\Resources\ArticleLikeCollection;

class UserArticleLikesController extends Controller
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

        $articleLikes = $user
            ->articleLikes()
            ->search($search)
            ->latest()
            ->paginate();

        return new ArticleLikeCollection($articleLikes);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', ArticleLike::class);

        $validated = $request->validate([
            'like' => ['required', 'boolean'],
            'dis_like' => ['required', 'boolean'],
            'article_id' => ['nullable', 'exists:articles,id'],
        ]);

        $articleLike = $user->articleLikes()->create($validated);

        return new ArticleLikeResource($articleLike);
    }
}
