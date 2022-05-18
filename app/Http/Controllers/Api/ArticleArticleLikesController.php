<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleLikeResource;
use App\Http\Resources\ArticleLikeCollection;

class ArticleArticleLikesController extends Controller
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

        $articleLikes = $article
            ->articleLikes()
            ->search($search)
            ->latest()
            ->paginate();

        return new ArticleLikeCollection($articleLikes);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $this->authorize('create', ArticleLike::class);

        $validated = $request->validate([
            'like' => ['required', 'boolean'],
            'dis_like' => ['required', 'boolean'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        $articleLike = $article->articleLikes()->create($validated);

        return new ArticleLikeResource($articleLike);
    }
}
