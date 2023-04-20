<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use App\Models\AttractionCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AttractionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $category = isset($request->category) ? AttractionCategory::whereSlug($request->category)->first() : null;

        // Get the attractions with their correspoding category, filter by category if needed, order by creation date, paginate by 20.
        $attractions = Attraction::select('id', 'slug', 'name', 'location', 'content', 'image', 'website_link', 'attraction_category_id')
            ->with('attraction_category')
            ->when($category, fn($query) => $query->where('attraction_category_id', $category->id))
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $attractionsCollection = $attractions->getCollection();

        $attractionsCollection->map(function($attraction) {
            $attraction->image_url = $attraction->image ? asset($attraction->image) : null;
        });

        $attractions->setCollection($attractionsCollection);

        return response()->json([
            'attractions' => $attractions
        ]);
    }

    public function categories(): JsonResponse
    {
        $categories = AttractionCategory::select('id', 'slug', 'name')->get();

        return response()->json([
            'categories' => $categories
        ]);
    }

    public function show($slug): JsonResponse
    {
        $attraction = Attraction::where('slug', $slug)->with('attraction_category')->firstOrFail();

        $attraction->image_url = $attraction->image ? asset($attraction->image) : null;
        $attraction->url = route('attractions.show', ['slug' => $attraction->slug]);

        return response()->json([
            'attraction' => $attraction
        ]);
    }
}
