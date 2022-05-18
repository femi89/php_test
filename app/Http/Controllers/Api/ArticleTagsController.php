<?php
namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;

class ArticleTagsController extends Controller
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

        $tags = $article
            ->tags()
            ->search($search)
            ->latest()
            ->paginate();

        return new TagCollection($tags);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article, Tag $tag)
    {
        $this->authorize('update', $article);

        $article->tags()->syncWithoutDetaching([$tag->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Article $article, Tag $tag)
    {
        $this->authorize('update', $article);

        $article->tags()->detach($tag);

        return response()->noContent();
    }
}
