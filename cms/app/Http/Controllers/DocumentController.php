<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Document;
use App\Models\DocumentCategory;

class DocumentController extends Controller
{
    // Documents list page.
    public function index(Request $request): Response
    {
        // Get the category if it's present in the URL.
        $category = isset($request->slug) ? DocumentCategory::whereSlug($request->slug)->first() : null;

        // Get the documents with their correspoding category, filter by category if needed, order by creation date, do not paginate (can't be so much of them?).
        $documents = Document::with('document_category')
            ->when($category, fn($query) => $query->where('document_category_id', $category->id))
            ->orderBy('created_at', 'desc')
            ->paginate(config('preferences.document.per_page', 50));

        // Get all the categories by their order for the sidebar.
        $categories = DocumentCategory::orderBy('lft')->get();

        return Inertia::render('Document/List', [
            'documents' => $documents,
            'currentCategory' => $category,
            'allCategories' => $categories
        ]);
    }
}
