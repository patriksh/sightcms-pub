<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class LandingController extends Controller
{
    // Landing page view.
    public function index(): Response
    {
        return Inertia::render('Landing');
    }

    // Get started button click. Loads the Builder if logged in, otherwise goes to the Register page.
    // A quick workaround because the Auth middleware would redirect to the login page.
    public function getStarted(): RedirectResponse
    {
        if(auth()->check()) {
            return redirect()->route('builder.intro');
        }

        return redirect()->route('register');
    }

    // Contact page view.
    public function contact(): Response
    {
        return Inertia::render('Contact', [
            'recaptchaSiteKey' => config('services.recaptcha.site_key'),
        ]);
    }

    // Contact page submission.
    public function contactPost(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|min:1|max:255',
            'message' => 'required|min:5',
            'recaptcha' => ['required', new Recaptcha]
        ]);

        // TODO: Load from config.
        Mail::to('contact@sightcms.app')->send(new Contact($request->all()));

        return redirect()->route('contact')->with('message', 'Your message has been sent successfully.');
    }

    // Privacy policy page view.
    public function privacyPolicy(): Response
    {
        return Inertia::render('PrivacyPolicy');
    }

    // Terms & conditions page view.
    public function termsAndConditions(): Response
    {
        return Inertia::render('TermsAndConditions');
    }
}
