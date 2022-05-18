<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ArticleLike;

use App\Models\Article;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleLikeTest extends TestCase
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
    public function it_gets_article_likes_list()
    {
        $articleLikes = ArticleLike::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.article-likes.index'));

        $response->assertOk()->assertSee($articleLikes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_article_like()
    {
        $data = ArticleLike::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.article-likes.store'), $data);

        $this->assertDatabaseHas('article_likes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_article_like()
    {
        $articleLike = ArticleLike::factory()->create();

        $article = Article::factory()->create();
        $user = User::factory()->create();

        $data = [
            'like' => $this->faker->boolean,
            'dis_like' => $this->faker->boolean,
            'article_id' => $article->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.article-likes.update', $articleLike),
            $data
        );

        $data['id'] = $articleLike->id;

        $this->assertDatabaseHas('article_likes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_article_like()
    {
        $articleLike = ArticleLike::factory()->create();

        $response = $this->deleteJson(
            route('api.article-likes.destroy', $articleLike)
        );

        $this->assertSoftDeleted($articleLike);

        $response->assertNoContent();
    }
}
