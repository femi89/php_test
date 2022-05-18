<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message' => $this->faker->sentence(20),
            'isGuest' => $this->faker->boolean,
            'guest_name' => $this->faker->text(255),
            'article_id' => \App\Models\Article::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
