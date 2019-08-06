<?php


namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class ForbidBannedUserCustom
{

    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**

     * @param \Illuminate\Contracts\Auth\Guard $auth

     */

    public function __construct(Guard $auth)

    {

        $this->auth = $auth;

    }


    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle($request, Closure $next)

    {

        $user = $this->auth->user();


        if ($user && $user->isBanned()) {

            \Session::flush();

            return redirect('login')->withInput()->withErrors([

                'email' => 'Tut uns Leid. Aber du wurdest gesperrt, weil du gegen die Seitenregeln verstoßen hast.
				Findest du, dass dies zu Unrecht geschehen ist? Dann kontaktiere uns persönlich.',

            ]);

        }


        return $next($request);

    }
}