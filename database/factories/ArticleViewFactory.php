<?php

namespace Database\Factories;

use App\Models\ArticleView;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArticleView::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'view' => $this->faker->randomNumber,
            'article_id' => \App\Models\Article::factory(),
        ];
    }
}
