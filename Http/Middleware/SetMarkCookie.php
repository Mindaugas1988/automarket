<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Illuminate\Support\Str;


class SetMarkCookie
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
        $uuid = Str::uuid();
        $time = 3600*24*365;

        if (Cookie::get('marked_cookie') === null) {
            Cookie::queue('marked_cookie',$uuid, $time);
        }
        return $next($request);
    }
}
