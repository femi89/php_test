<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleViewResource;
use App\Http\Resources\ArticleViewCollection;

class ArticleArticleViewsController extends Controller
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

        $articleViews = $article
            ->articleViews()
            ->search($search)
            ->latest()
            ->paginate();

        return new ArticleViewCollection($articleViews);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $this->authorize('create', ArticleView::class);

        $validated = $request->validate([
            'view' => ['required', 'max:255'],
        ]);

        $articleView = $article->articleViews()->create($validated);

        return new ArticleViewResource($articleView);
    }
}
