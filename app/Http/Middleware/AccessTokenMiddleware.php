<?php
namespace App\Http\Middleware;

use Closure;

class AccessTokenMiddleware
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
       $request->headers->add(['Authorization' => "Bearer {$request->access_token}"]);

       return $next($request);
   }
}