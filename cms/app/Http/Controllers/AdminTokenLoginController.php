<?php

namespace App\Http\Controllers;

use App\Models\LoginToken;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AdminTokenLoginController extends Controller
{
    // Used for logging in from the landlord websites list, via a token.
    public function index($token): RedirectResponse
    {
        $tenant = app('currentTenant');

        // Try to find the hashed token for the current tenant and make sure it didn't expired.
        $loginToken = LoginToken::where('tenant_id', $tenant->id)
            ->where('token', hash('sha256', $token))
            ->where('expires_at', '>=', now())
            ->firstOrFail();

        // Get the owner user.
        $adminUser = User::where('owner', true)->first();

        // Login the user.
        backpack_auth()->login($adminUser, true); // true = remember me.

        // Delete the token.
        $loginToken->delete();

        // Redirect to the Backpack dashboard.
        return redirect('/admin');
    }
}
