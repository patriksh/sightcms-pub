<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Gastro;
use App\Models\GastroCategory;

class GastroController extends Controller
{
    // Gastro list page.
    public function index(Request $request): Response
    {
        // Get the category if it's present in the URL.
        $category = isset($request->slug) ? GastroCategory::whereSlug($request->slug)->first() : null;

        // Get the gastros with their correspoding category, filter by category if needed, order by creation date, paginate by 12.
        $gastros = Gastro::with('gastro_category')
            ->when($category, fn($query) => $query->where('gastro_category_id', $category->id))
            ->orderBy('created_at', 'desc')
            ->paginate(config('preferences.gastro.per_page', 12));

        // Get all the categories by their order for the sidebar.
        $categories = GastroCategory::orderBy('lft')->get();

        return Inertia::render('Gastro/List', [
            'gastros' => $gastros,
            'currentCategory' => $category,
            'allCategories' => $categories
        ]);
    }

    // Gastro view page.
    public function show(Request $request): Response
    {
        // Get the gastro from the slug in the URL with its corresponding category.
        $gastro = Gastro::whereSlug($request->slug)->with('gastro_category')->first();

        return Inertia::render('Gastro/Single', [
            'gastro' => $gastro
        ]);
    }
}
