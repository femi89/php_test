<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ArticleLike;

use App\Models\Article;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleLikeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_article_likes()
    {
        $articleLikes = ArticleLike::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('article-likes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.article_likes.index')
            ->assertViewHas('articleLikes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_article_like()
    {
        $response = $this->get(route('article-likes.create'));

        $response->assertOk()->assertViewIs('app.article_likes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_article_like()
    {
        $data = ArticleLike::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('article-likes.store'), $data);

        $this->assertDatabaseHas('article_likes', $data);

        $articleLike = ArticleLike::latest('id')->first();

        $response->assertRedirect(route('article-likes.edit', $articleLike));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_article_like()
    {
        $articleLike = ArticleLike::factory()->create();

        $response = $this->get(route('article-likes.show', $articleLike));

        $response
            ->assertOk()
            ->assertViewIs('app.article_likes.show')
            ->assertViewHas('articleLike');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_article_like()
    {
        $articleLike = ArticleLike::factory()->create();

        $response = $this->get(route('article-likes.edit', $articleLike));

        $response
            ->assertOk()
            ->assertViewIs('app.article_likes.edit')
            ->assertViewHas('articleLike');
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

        $response = $this->put(
            route('article-likes.update', $articleLike),
            $data
        );

        $data['id'] = $articleLike->id;

        $this->assertDatabaseHas('article_likes', $data);

        $response->assertRedirect(route('article-likes.edit', $articleLike));
    }

    /**
     * @test
     */
    public function it_deletes_the_article_like()
    {
        $articleLike = ArticleLike::factory()->create();

        $response = $this->delete(route('article-likes.destroy', $articleLike));

        $response->assertRedirect(route('article-likes.index'));

        $this->assertSoftDeleted($articleLike);
    }
}
