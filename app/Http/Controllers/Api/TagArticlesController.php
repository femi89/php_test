<?php
namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;

class TagArticlesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tag $tag)
    {
        $this->authorize('view', $tag);

        $search = $request->get('search', '');

        $articles = $tag
            ->articles()
            ->search($search)
            ->latest()
            ->paginate();

        return new ArticleCollection($articles);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag, Article $article)
    {
        $this->authorize('update', $tag);

        $tag->articles()->syncWithoutDetaching([$article->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tag $tag, Article $article)
    {
        $this->authorize('update', $tag);

        $tag->articles()->detach($article);

        return response()->noContent();
    }
}
