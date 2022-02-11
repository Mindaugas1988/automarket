<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckEdit
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
        if (Auth::user() &&  Auth::id() === $request->advert->user_id) {

            return $next($request);

        }
        return redirect('/');
    }
}
