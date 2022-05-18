<?php

namespace App\Http\Controllers\Api;

use App\Models\ArticleLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleLikeResource;
use App\Http\Resources\ArticleLikeCollection;
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
            ->paginate();

        return new ArticleLikeCollection($articleLikes);
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

        return new ArticleLikeResource($articleLike);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ArticleLike $articleLike
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ArticleLike $articleLike)
    {
        $this->authorize('view', $articleLike);

        return new ArticleLikeResource($articleLike);
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

        return new ArticleLikeResource($articleLike);
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

        return response()->noContent();
    }
}
