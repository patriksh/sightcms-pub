<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    // Insert a demo article.
    public function run()
    {
        $articleCategory = ArticleCategory::create([
            'name' => 'News',
            'slug' => 'news',
            'icon' => 'far fa-newspaper'
        ]);

        Article::create([
            'title' => 'A new website is in town!',
            'content' => 'sightcms reports that a new website has just moved in!<br>This is the default article. You can edit it in your dashboard.',
            'article_category_id' => $articleCategory->id,
            'user_id' => User::first()->id,
            'published_at' => \Carbon\Carbon::now()->toIso8601String()
        ]);
    }
}
