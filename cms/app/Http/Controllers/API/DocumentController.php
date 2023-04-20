<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $category = isset($request->category) ? DocumentCategory::whereSlug($request->category)->first() : null;

        // Get the documents with their correspoding category, filter by category if needed, order by creation date, paginate by 20.
        $documents = Document::select('id', 'name', 'file', 'document_category_id')
            ->with('document_category')
            ->when($category, fn($query) => $query->where('document_category_id', $category->id))
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $documentsCollection = $documents->getCollection();

        $documentsCollection->map(function($document) {
            $document->file_url = $document->file ? asset($document->file) : null;
        });

        $documents->setCollection($documentsCollection);

        return response()->json([
            'documents' => $documents
        ]);
    }

    public function categories(): JsonResponse
    {
        $categories = DocumentCategory::select('id', 'slug', 'name')->get();

        return response()->json([
            'categories' => $categories
        ]);
    }
}
