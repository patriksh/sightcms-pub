<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Attraction;
use App\Models\AttractionCategory;

class AttractionController extends Controller
{
    // Attractions list page.
    public function index(Request $request): Response
    {
        // Get the category if it's present in the URL.
        $category = isset($request->slug) ? AttractionCategory::whereSlug($request->slug)->first() : null;

        // Get the attractions with their correspoding category, filter by category if needed, order by creation date, paginate by 12.
        $attractions = Attraction::with('attraction_category')
            ->when($category, fn($query) => $query->where('attraction_category_id', $category->id))
            ->orderBy('created_at', 'desc')
            ->paginate(config('preferences.attraction.per_page', 12));

        // Get all the categories by their order for the sidebar.
        $categories = AttractionCategory::orderBy('lft')->get();

        return Inertia::render('Attraction/List', [
            'attractions' => $attractions,
            'currentCategory' => $category,
            'allCategories' => $categories
        ]);
    }

    // Attraction view page.
    public function show(Request $request): Response
    {
        // Get the attraction from the slug in the URL with its corresponding category.
        $attraction = Attraction::whereSlug($request->slug)->with('attraction_category')->first();

        return Inertia::render('Attraction/Single', [
            'attraction' => $attraction
        ]);
    }
}
