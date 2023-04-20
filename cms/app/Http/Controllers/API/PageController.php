<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function index(): JsonResponse
    {
        // Get the pages.
        $pages = Page::select('id', 'slug', 'title')->where('show_in_app', '1')->get();

        return response()->json([
            'pages' => $pages
        ]);
    }

    public function show($slug): JsonResponse
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return response()->json([
            'page' => $page
        ]);
    }
}
