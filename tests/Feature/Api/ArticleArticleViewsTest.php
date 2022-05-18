<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Article;
use App\Models\ArticleView;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleArticleViewsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_article_article_views()
    {
        $article = Article::factory()->create();
        $articleViews = ArticleView::factory()
            ->count(2)
            ->create([
                'article_id' => $article->id,
            ]);

        $response = $this->getJson(
            route('api.articles.article-views.index', $article)
        );

        $response->assertOk()->assertSee($articleViews[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_article_article_views()
    {
        $article = Article::factory()->create();
        $data = ArticleView::factory()
            ->make([
                'article_id' => $article->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.articles.article-views.store', $article),
            $data
        );

        unset($data['article_id']);
        unset($data['view']);

        $this->assertDatabaseHas('article_views', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $articleView = ArticleView::latest('id')->first();

        $this->assertEquals($article->id, $articleView->article_id);
    }
}
