<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    // Profile form view.
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail, // Checks for MustVerifyEmail interface on the User model.
            'status' => session('status'), // TODO: Replace 'status' with 'message', with a generic flash message component.
        ]);
    }

    // Profile form submission.
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255'],
        ]);

        $request->user()->fill($request->all());

        // Check that the email is unique if it was changed.
        // A workaround for MongoDB, where the ignore() method doesn't work on the unique rule.
        if($request->user()->isDirty('email')) {
            $request->validate([
                'email' => ['unique:users,email'],
            ]);

            // Reset the email verification timestamp.
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    // Delete account submission.
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
