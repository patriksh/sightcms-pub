<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $allowedLanguages = ['en', 'hr'];

        if($request->session()->has('language')) {
            $language = $request->session()->get('language');
        }

        if($request->cookie('language')) {
            $language = $request->cookie('language');
        }

        if(isset($language) && in_array($language, $allowedLanguages)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
