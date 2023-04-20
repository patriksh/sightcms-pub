<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\HomeBlock;

class HomeController extends Controller
{
    // Homepage.
    public function index(): Response
    {
        // Get the home blocks with their corresponding data.
        $blocks = HomeBlock::getWithData();

        return Inertia::render('Home', [
            'blocks' => $blocks
        ]);
    }
}
