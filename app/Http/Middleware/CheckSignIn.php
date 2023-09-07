<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSignIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $r, Closure $next)
    {

        if(
            !session()->has('user_id') &&
            $r->path() != 'signIn'
        )
        {
            return redirect('signIn')->with('error', 'Kinly login first');
        }

        if
        (
            session()->has('user_id') &&
            $r->path() == 'signIn'
        )
        {
            return redirect('home');
        }


        return $next($r);
    }
}
