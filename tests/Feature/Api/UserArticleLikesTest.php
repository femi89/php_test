<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ArticleLike;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserArticleLikesTest extends TestCase
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
    public function it_gets_user_article_likes()
    {
        $user = User::factory()->create();
        $articleLikes = ArticleLike::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.article-likes.index', $user)
        );

        $response->assertOk()->assertSee($articleLikes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_user_article_likes()
    {
        $user = User::factory()->create();
        $data = ArticleLike::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.article-likes.store', $user),
            $data
        );

        $this->assertDatabaseHas('article_likes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $articleLike = ArticleLike::latest('id')->first();

        $this->assertEquals($user->id, $articleLike->user_id);
    }
}
