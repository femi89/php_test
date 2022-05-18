<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleCommentsTest extends TestCase
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
    public function it_gets_article_comments()
    {
        $article = Article::factory()->create();
        $comments = Comment::factory()
            ->count(2)
            ->create([
                'article_id' => $article->id,
            ]);

        $response = $this->getJson(
            route('api.articles.comments.index', $article)
        );

        $response->assertOk()->assertSee($comments[0]->message);
    }

    /**
     * @test
     */
    public function it_stores_the_article_comments()
    {
        $article = Article::factory()->create();
        $data = Comment::factory()
            ->make([
                'article_id' => $article->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.articles.comments.store', $article),
            $data
        );

        $this->assertDatabaseHas('comments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $comment = Comment::latest('id')->first();

        $this->assertEquals($article->id, $comment->article_id);
    }
}
