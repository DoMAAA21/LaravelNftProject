<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if (! $request->expectsJson()) {
        //     return response()->json();
        // }

    //     if (! $request->expectsJson()) {

    //         return 'hatdog';
    //        // return response()->json(['status_message' => 'Unauthorised'], 401);
    //     }
    // }
    

    // public function handle($request)
    // {
    //     if ($this->auth->guard($guard)->guest()) {
    //         return response('Unauthorized.', 401);
    //     }

    //     return $next($request);
    // }
    }

    protected function unauthenticated($request, array $guards)
    {
        abort(response()->json(['message' => 'Unauthenticated.'], 401));
    }
}
