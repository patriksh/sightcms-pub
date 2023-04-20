<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
// use Inertia\Response;

class DashboardController extends Controller
{
    // For now, use the website list page as the dashboard.
    public function index(): RedirectResponse // : Response
    {
        return redirect()->route('website.list');
        // return inertia('Dashboard');
    }
}
