<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\User;

class ValidateField
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( Request $request, Closure $next, $type )
    {   
        $validates = [
            'email'				=>	'required',
            'password'			=>	'required',
        ];

        if( $type === 'signIn' ){

            $validates[ 'name' ] =	'required';
            $validates[ 'email' ] =	'required|email|unique:users,email';
        } //end if

        $errors = check( $request -> all(), $validates );

        if( ! is_null( $errors ) ){

            return response( [
                        'msg' => $errors[ 'msg' ],
                        'field'=> $errors[ 'key' ],
                    ], 400 );

        } //end if

        return $next( $request );
    }
}
