<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XssSanitization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userInput = $request->all();
        $allowedTags = '<p><b><i><u><ul><ol><li><br><strong><em>';
        array_walk_recursive($userInput, function (&$userInput) use ($allowedTags) {
            $userInput = strip_tags($userInput, $allowedTags);
        });
        $request->merge($userInput);

        return $next($request);
    }
}
