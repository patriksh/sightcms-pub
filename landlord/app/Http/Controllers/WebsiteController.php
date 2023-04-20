<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class WebsiteController extends Controller
{
    // Website list view.
    public function list()
    {
        // Get websites of the current user.
        $websites = Tenant::where('user_id', auth()->id())->get();

        return Inertia::render('Website/List', [
            'websites' => $websites
        ]);
    }

    // Website edit view.
    public function edit($id)
    {
        $tenant = Tenant::where('user_id', auth()->id())->findOrFail($id);

        return Inertia::render('Website/Edit', [
            'website' => $tenant
        ]);
    }

    // Website edit submission.
    public function update($id): RedirectResponse
    {
        $tenant = Tenant::where('user_id', auth()->id())->findOrFail($id);
        
        $tenant->update(request()->validate([
            'name' => ['required', 'string', 'max:255'],
            // TODO: Domain change feature (at least allow subdomain modification).
            // 'domain' => ['required', 'string', 'max:255'],
        ]));

        return redirect()->route('website.edit', $tenant->id);
    }

    // Redirect to website dashboard.
    public function redirectToDashboard($id): RedirectResponse
    {
        // Get the website by ID.
        $tenant = Tenant::where('user_id', auth()->id())->findOrFail($id);

        // Get the domain of the website (on local, it's a Laravel instance on another port).
        // TODO: Load local domain from config.
        $domain = app()->environment('local') ? 'http://127.0.0.1:8010' : '//' . $tenant->domain;

        // Generate a login token.
        $token = Str::random(256);

        $tenant->loginTokens()->create([
            'token' => hash('sha256', $token), // Hash the token.
            'expires_at' => now()->addMinutes(5) // Make it expire after 5 minutes (enough time to redirect, even if migrating or something).
        ]);

        // Redirect to the login url.
        return redirect($domain . '/admin-token-login/' . $token);
    }
}
