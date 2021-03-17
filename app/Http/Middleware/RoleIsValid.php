<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request -> user();
        
        if( $user -> role_id !== 1 )
            return response( [
                'msg' => 'unauthorized'
            ], 400 );

        return $next($request);
    }
}
