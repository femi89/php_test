<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Article;
use App\Models\ArticleLike;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleArticleLikesTest extends TestCase
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
    public function it_gets_article_article_likes()
    {
        $article = Article::factory()->create();
        $articleLikes = ArticleLike::factory()
            ->count(2)
            ->create([
                'article_id' => $article->id,
            ]);

        $response = $this->getJson(
            route('api.articles.article-likes.index', $article)
        );

        $response->assertOk()->assertSee($articleLikes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_article_article_likes()
    {
        $article = Article::factory()->create();
        $data = ArticleLike::factory()
            ->make([
                'article_id' => $article->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.articles.article-likes.store', $article),
            $data
        );

        $this->assertDatabaseHas('article_likes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $articleLike = ArticleLike::latest('id')->first();

        $this->assertEquals($article->id, $articleLike->article_id);
    }
}
