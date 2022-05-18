<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\ArticleLike;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleLikeStoreRequest;
use App\Http\Requests\ArticleLikeUpdateRequest;

class ArticleLikeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ArticleLike::class);

        $search = $request->get('search', '');

        $articleLikes = ArticleLike::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.article_likes.index',
            compact('articleLikes', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', ArticleLike::class);

        $articles = Article::pluck('subject', 'id');
        $users = User::pluck('name', 'id');

        return view('app.article_likes.create', compact('articles', 'users'));
    }

    /**
     * @param \App\Http\Requests\ArticleLikeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleLikeStoreRequest $request)
    {
        $this->authorize('create', ArticleLike::class);

        $validated = $request->validated();

        $articleLike = ArticleLike::create($validated);

        return redirect()
            ->route('article-likes.edit', $articleLike)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ArticleLike $articleLike
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ArticleLike $articleLike)
    {
        $this->authorize('view', $articleLike);

        return view('app.article_likes.show', compact('articleLike'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ArticleLike $articleLike
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ArticleLike $articleLike)
    {
        $this->authorize('update', $articleLike);

        $articles = Article::pluck('subject', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.article_likes.edit',
            compact('articleLike', 'articles', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\ArticleLikeUpdateRequest $request
     * @param \App\Models\ArticleLike $articleLike
     * @return \Illuminate\Http\Response
     */
    public function update(
        ArticleLikeUpdateRequest $request,
        ArticleLike $articleLike
    ) {
        $this->authorize('update', $articleLike);

        $validated = $request->validated();

        $articleLike->update($validated);

        return redirect()
            ->route('article-likes.edit', $articleLike)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ArticleLike $articleLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ArticleLike $articleLike)
    {
        $this->authorize('delete', $articleLike);

        $articleLike->delete();

        return redirect()
            ->route('article-likes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
