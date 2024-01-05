<?php

namespace App\Http\Middleware;

use App\Enums\Language\Language;
use Closure;
use Illuminate\Http\Request;

class SetLocale
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
        app()->setLocale($this->parseHttpLocale($request));

        return $next($request);
    }

    private function parseHttpLocale(Request $request): string
    {
        $preferredLanguage = $request->getPreferredLanguage();

        if (!$preferredLanguage || !in_array($preferredLanguage, Language::values())) {
            return config('app.locale');
        }

        return $preferredLanguage;
    }
}
