<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gastro;
use App\Models\GastroCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GastroController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $category = isset($request->category) ? GastroCategory::whereSlug($request->category)->first() : null;

        // Get the gastros with their correspoding category, filter by category if needed, order by creation date, paginate by 20.
        $gastros = Gastro::select('id', 'slug', 'name', 'location', 'content', 'image', 'website_link', 'gastro_category_id')
            ->with('gastro_category')
            ->when($category, fn($query) => $query->where('gastro_category_id', $category->id))
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $gastrosCollection = $gastros->getCollection();

        $gastrosCollection->map(function($gastro) {
            $gastro->image_url = $gastro->image ? asset($gastro->image) : null;
        });

        $gastros->setCollection($gastrosCollection);

        return response()->json([
            'gastros' => $gastros
        ]);
    }

    public function categories(): JsonResponse
    {
        $categories = GastroCategory::select('id', 'slug', 'name')->get();

        return response()->json([
            'categories' => $categories
        ]);
    }

    public function show($slug): JsonResponse
    {
        $gastro = Gastro::where('slug', $slug)->with('gastro_category')->firstOrFail();

        $gastro->image_url = $gastro->image ? asset($gastro->image) : null;
        $gastro->url = route('gastros.show', ['slug' => $gastro->slug]);

        return response()->json([
            'gastro' => $gastro
        ]);
    }
}
