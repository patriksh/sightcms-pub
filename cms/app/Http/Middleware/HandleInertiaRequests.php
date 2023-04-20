<?php

namespace App\Http\Middleware;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request)// : string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'globalPreferences' => [
                'identity' => [
                    'name' => config('preferences.identity.name'),
                    'description' => config('preferences.identity.description'),
                    'logo' => config('preferences.identity.logo_file'),
                ],
                'footer' => [
                    'copyright' => config('preferences.footer.copyright'),
                    'socials' => json_decode(config('preferences.footer.socials')), // TODO: Figure can I prevent JSON encoding of table values (not needed with MongoDB).
                ],
                'seo' => [
                    'title' => config('preferences.seo.title'),
                    'description' => config('preferences.seo.description'),
                    'image' => config('preferences.seo.image_file'),
                ],
                'sightcms' => [
                    'version' => config('sightcms.version'),
                    'color' => config('sightcms.color'),
                    'link' => config('sightcms.link'),
                ],
                'tenant' => [
                    'slug' => app('currentTenant')->slug
                ]
            ],
            'storageUrl' => asset(''),
            'menu' => MenuItem::getTree(),
        ]);
    }
}
