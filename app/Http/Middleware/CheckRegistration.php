<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRegistration
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
                !session()->has('verification_id') && 
                $r->path() != 'registration' &&
                !session()->has('student_id')
            )
            {
                return redirect('registration')->with('error', 'Kindly register first');
            }

            if(
                session()->has('verification_id') &&
                $r->path() != 'verification' &&
                !session()->has('student_id')
            )
            {
                return redirect('verification')->with('error', 'Kindly verify your registration');
            }

            if(
                !session()->has('verification_id') && 
                ($r->path() == 'verification' || $r->path() == 'registration') &&
                session()->has('student_id')
            )
            {
                return redirect('preassessment');
            }

        return $next($r);
    }
}
