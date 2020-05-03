<?php

namespace App\Http\Middleware;

use Closure;

class ValidateNumberN
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->n >= 1 && $request->n <= 1000000) {
            return $next($request);
        }

        abort(404);
    }
}
