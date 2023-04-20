<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\AudioTour;

class AudioTourController extends Controller
{
    // Audio tours list page.
    public function index(): Response
    {
        // Get the audio tours, order by creation date, paginate by 12.
        $audioTours = AudioTour::select('id', 'title', 'slug', 'duration', 'image')
            ->orderBy('created_at', 'DESC')
            ->paginate(config('preferences.audiotour.per_page', 12));

        return Inertia::render('AudioTour/List', [
            'audioTours' => $audioTours
        ]);
    }

    // Audio tour view page.
    public function show(Request $request): Response
    {
        // Get the audio tour from the slug in the URL.
        $audioTour = AudioTour::whereSlug($request->slug)->first();

        // Calculate the file size of the audio tour file.
        $audioTour->file_size = getReadableFileSize(filesize(public_path('storage/' . $audioTour->file)));

        return Inertia::render('AudioTour/Single', [
            'audioTour' => $audioTour
        ]);
    }
}
