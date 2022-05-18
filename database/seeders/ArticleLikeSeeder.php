<?php

namespace Database\Seeders;

use App\Models\ArticleLike;
use Illuminate\Database\Seeder;

class ArticleLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticleLike::factory()
            ->count(5)
            ->create();
    }
}
