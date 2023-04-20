<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Event;

class EventController extends Controller
{
    // Events list page.
    public function index(): Response
    {
        // Get the events, order by creation date.
        $events = Event::orderBy('created_at', 'desc')->get();

        return Inertia::render('Event/List', [
            'events' => $events
        ]);
    }

    public function show(Request $request): Response
    {
        // Get the event from the slug in the URL.
        $event = Event::whereSlug($request->slug)->first();

        return Inertia::render('Event/Single', [
            'event' => $event
        ]);
    }
}
