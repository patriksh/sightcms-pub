<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\SubscriptionPlan;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BuilderController extends Controller
{
    // Builder intro view (without a form).
    public function intro(): Response
    {
        return Inertia::render('Builder/Builder', [
            'step' => 0
        ]);
    }

    // Builder step 1 view (name form).
    public function step1(Request $request): Response
    {
        return Inertia::render('Builder/Builder', [
            'step' => 1,
            'name' => $request->session()->get('builder.name') // In case it was already filled out.
        ]);
    }

    // Builder step 1 submission.
    public function step1Post(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Save form data (name) to the session.
        $request->session()->put('builder.name', $request->name);

        // Move to the next step.
        return to_route('builder.step2');
    }

    // Builder step 2 view (type form).
    public function step2(Request $request): Response
    {
        return Inertia::render('Builder/Builder', [
            'step' => 2,
            'name' => $request->session()->get('builder.name'),
            'type' => $request->session()->get('builder.type') // In case it was already filled out.
        ]);
    }

    // Builder step 2 submission.
    public function step2Post(Request $request): RedirectResponse
    {        
        // Allow only "government", "tourism", "all" options.
        // TODO: Enumerate these.
        $request->validate([
            'type' => 'required|in:government,tourism,all',
        ]);

        // Save form data (type) to the session.
        $request->session()->put('builder.type', $request->type);

        // Move to the next step.
        return to_route('builder.step3');
    }

    // Builder step 3 view (plan form).
    public function step3(Request $request): Response
    {
        $subscriptionPlans = SubscriptionPlan::orderBy('order')->get();

        return Inertia::render('Builder/Builder', [
            'step' => 3,
            'name' => $request->session()->get('builder.name'),
            'type' => $request->session()->get('builder.type'),
            'plan' => $request->session()->get('builder.plan'), // In case it was already filled out.,
            'plans' => $subscriptionPlans
        ]);
    }

    // Builder step 3 submission.
    public function step3Post(Request $request): RedirectResponse
    {
        // TODO: Allow only "free" plan (in future, check if the plan exists in the database).
        $request->validate([
            'plan' => 'required|in:free',
        ]);

        $name = $request->session()->get('builder.name');
        $type = $request->session()->get('builder.type');
        $plan = $request->plan;
        
        // Create a slug for the website before inserting it so it can be used in the database & domain name.
        $slug = SlugService::createSlug(Tenant::class, 'slug', $name);

        // Create the website (tenant) record.
        $tenant = new Tenant([
            'slug' => $slug,
            'user_id' => auth()->id(),
            'name' => $name,
            'type' => $type,
            'plan' => $plan,
            'database' => 'sightcms-' . $slug, // TODO: Load from config.
            'domain' => $slug . '.sightcms.app', // TODO: Load from config.
            'migrated' => false
        ]);

        $tenant->save();

        // Save the website record ID, so we can redirect to the dashboard in finish step.
        $request->session()->put('builder.id', $tenant->id);

        // Move to the finish step.
        return to_route('builder.finish');
    }

    // Builder finish view.
    public function finish(Request $request): Response
    {
        // Get the websire record ID.
        $id = $request->session()->get('builder.id');

        // Then clear the session values.
        $request->session()->forget(['builder.name', 'builder.type', 'builder.id']);

        return Inertia::render('Builder/Builder', [
            'finish' => true,
            'website_id' => $id
        ]);
    }
}
