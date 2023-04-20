<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function set(Request $request, $language)
    {
        $request->session()->put('language', $language);
        cookie()->queue('language', $language, 60 * 24 * 365); // 365 days

        return redirect()->back();
    }
}
