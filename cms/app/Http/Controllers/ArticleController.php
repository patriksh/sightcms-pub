<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Article;
use App\Models\ArticleCategory;

class ArticleController extends Controller
{
    // Articles list page.
    public function index(Request $request): Response
    {
        // Get the category if it's present in the URL.
        $category = isset($request->slug) ? ArticleCategory::whereSlug($request->slug)->first() : null;

        // Get the articles with their correspoding category, filter by category if needed, order by publish date, paginate by 12.
        $articles = Article::select('id', 'title', 'slug', 'summary', 'image', 'article_category_id', 'published_at')
            ->with('article_category')
            ->when($category, fn($query) => $query->where('article_category_id', $category->id))
            ->where('published_at', '<=', \Carbon\Carbon::now()->toIso8601String())
            ->orderBy('published_at', 'DESC')
            ->paginate(config('preferences.article.per_page', 12));

        // Get all the categories by their order for the sidebar.
        $categories = ArticleCategory::orderBy('lft')->get();

        return Inertia::render('Article/List', [
            'articles' => $articles,
            'currentCategory' => $category,
            'allCategories' => $categories
        ]);
    }

    // Article view page.
    public function show(Request $request): Response
    {
        // Get the article from the slug in the URL with its corresponding category.
        $article = Article::whereSlug($request->slug)->with('article_category')->first();

        // Get 4 related articles (same category, not the same article) ordered by publish date.
        $relatedArticles = Article::with('article_category')
            ->where('_id', '!=', $article->_id)
            ->where('article_category_id', $article->article_category_id)
            ->where('published_at', '<=', \Carbon\Carbon::now()->toIso8601String())
            ->orderBy('published_at', 'DESC')
            ->limit(4)
            ->get();

        return Inertia::render('Article/Single', [
            'article' => $article,
            'relatedArticles' => $relatedArticles
        ]);
    }
}
