<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Page;

class PageController extends Controller
{
    // Static page view.
    public function show(Request $request): Response
    {
        // Get the page from the slug in the URL.
        $page = Page::whereSlug($request->page)->first();

        return Inertia::render('Page', [
            'page' => $page,
        ]);
    }
}
