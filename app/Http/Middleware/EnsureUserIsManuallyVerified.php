<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class EnsureUserIsManuallyVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasBeenManuallyVerified())) {
            return $request->expectsJson()
                    ? abort(403, 'Du wurdest noch nicht von uns freigeschaltet')
                    : Redirect::route('mailpdf.verifyManually');
        }

        return $next($request);
    }
}
