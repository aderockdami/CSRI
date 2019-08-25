<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\User;

class isResultOwner
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
      if(User::isResultOwner(User::getUser(),$request->route('user'))){
        return $next($request);
      }
      return response()->json(['error'=>'unathorised'],401);
    }
}
