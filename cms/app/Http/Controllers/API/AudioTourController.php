<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AudioTour;
use App\Models\AudioTourCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AudioTourController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // Get the audio tours, order by creation date, paginate by 20.
        $audioTours = AudioTour::select('id', 'title', 'slug', 'duration', 'image')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        $audioToursCollection = $audioTours->getCollection();

        $audioToursCollection->map(function($audioTour) {
            $audioTour->image_url = $audioTour->image ? asset($audioTour->image) : null;
        });

        $audioTours->setCollection($audioToursCollection);

        return response()->json([
            'audioTours' => $audioTours
        ]);
    }

    public function show($slug): JsonResponse
    {
        $audioTour = AudioTour::where('slug', $slug)->firstOrFail();

        $audioTour->image_url = $audioTour->image ? asset($audioTour->image) : null;
        $audioTour->file_url = $audioTour->file ? asset($audioTour->file) : null;

        // Calculate the file size of the audio tour file.
        $audioTour->file_size = getReadableFileSize(filesize(public_path('storage/' . $audioTour->file)));

        $audioTour->url = route('audio-tours.show', ['slug' => $audioTour->slug]);

        return response()->json([
            'audioTour' => $audioTour
        ]);
    }
}
