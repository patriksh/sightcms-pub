<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $type = isset($request->type) ? $request->type : null;

        // Get the events, filter by date , paginate by 20.
        $events = Event::select('id', 'slug', 'title', 'date_from', 'date_to', 'location', 'image')
            // Only events in the past.
            ->when(($type == 'past'), function($query) {
                return $query->where('date_to', '<', now()->toISOString());
            })
            // Only events in the future.
            ->when(($type == 'upcoming'), function($query) {
                return $query->where('date_from', '>', now()->toISOString());
            })
            // TODO: Refine to get running events, even if they started before and last for weeks/months?
            // Only events starting or ending this week.
            ->when(($type == 'week'), function($query) {
                return $query->where('date_from', [now()->startOfWeek()->toISOString(), now()->endOfWeek()->toISOString()])
                    ->orWhereBetween('date_to', [now()->startOfWeek()->toISOString(), now()->endOfWeek()->toISOString()]);
            })
            // Only events starting or ending this month.
            ->when(($type == 'month'), function($query) {
                return $query->whereBetween('date_from', [now()->startOfMonth()->toISOString(), now()->endOfMonth()->toISOString()])
                    ->orWhereBetween('date_to', [now()->startOfMonth()->toISOString(), now()->endOfMonth()->toISOString()]);
            })
            ->orderBy('date_from', 'desc') // TODO: Figure what's the best order?
            ->paginate(20);

        $eventsCollection = $events->getCollection();
        $eventsCollection->map(function($event) {
            $event->image_url = $event->image ? asset($event->image) : null;
            $event->logo_url = $event->logo ? asset($event->logo) : null;
        });
        $events->setCollection($eventsCollection);

        return response()->json([
            'events' => $events
        ]);
    }

    public function show($slug): JsonResponse
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        $event->image_url = $event->image ? asset($event->image) : null;
        $event->logo_url = $event->logo ? asset($event->logo) : null;
        $event->url = route('events.show', ['slug' => $event->slug]);

        return response()->json([
            'event' => $event
        ]);
    }
}
