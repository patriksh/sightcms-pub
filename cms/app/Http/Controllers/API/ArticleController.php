<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $category = isset($request->category) ? ArticleCategory::whereSlug($request->category)->first() : null;

        // Get the articles with their correspoding category, filter by category if needed, order by publish date, paginate by 20.
        $articles = Article::select('id', 'slug', 'title', 'summary', 'image', 'article_category_id', 'published_at')
            ->with('article_category')
            ->when($category, fn($query) => $query->where('article_category_id', $category->id))
            ->where('published_at', '<=', \Carbon\Carbon::now()->toIso8601String())
            ->orderBy('published_at', 'DESC')
            ->paginate(20);

        $articlesCollection = $articles->getCollection();

        $articlesCollection->map(function($article) {
            $article->image_url = $article->image ? asset($article->image) : null;
        });

        $articles->setCollection($articlesCollection);

        return response()->json([
            'articles' => $articles
        ]);
    }

    public function categories(): JsonResponse
    {
        $categories = ArticleCategory::select('id', 'slug', 'name')->get();

        return response()->json([
            'categories' => $categories
        ]);
    }

    public function show($slug): JsonResponse
    {
        $article = Article::where('slug', $slug)->with('article_category')->firstOrFail();

        $article->image_url = $article->image ? asset($article->image) : null;
        $article->url = route('articles.show', ['slug' => $article->slug]);

        return response()->json([
            'article' => $article
        ]);
    }
}
