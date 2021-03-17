<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IdIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( Request $request, Closure $next )
    {
        $params = $request->route()->parameters();
        
        $isId = isId( $params );

        if( ! $isId )
            return response( [
                'msg' => 'No exist record Id in data Base'
            ], 400 );

        return $next( $request );
    }
}
