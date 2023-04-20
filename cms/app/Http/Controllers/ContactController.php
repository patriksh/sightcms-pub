<?php

namespace App\Http\Controllers;

use App\Rules\Recaptcha;
use App\Mail\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Contact', [
            'recaptchaSiteKey' => config('services.recaptcha.site_key'),
            'contactSubtitle' => config('preferences.contact.subtitle'),
            'contactInformation' => config('preferences.contact.info'),
            'contactCategories' => array_map('trim', explode(',', config('preferences.contact.categories')))
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|min:1|max:255',
            'message' => 'required|min:5',
            'recaptcha' => ['required', new Recaptcha]
        ]);

        // Now actually have to load the admin email or something?
        Mail::to(config('preferences.contact.email'))->send(new Contact($request->all()));

        return redirect()->route('contact.index')->with('message', 'Your message has been sent successfully.');
    }
}
