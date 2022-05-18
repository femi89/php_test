<?php

namespace Database\Factories;

use App\Models\ArticleLike;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleLikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArticleLike::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'like' => $this->faker->boolean,
            'dis_like' => $this->faker->boolean,
            'article_id' => \App\Models\Article::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
