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
        if( $type === 'login' ){

            $validates = [
                'email'				=>	'required',
                'password'			=>	'required',
            ];
        } //end if

        if( $type === 'signIn' ){

            $validates = [
                'name'              =>  'required',
                'email'				=>	'required|email|unique:users,email',
                'password'			=>	'required',
            ];
        } //end if

        if( $type === 'user' ){

            $validates = [
                'name'              =>  'required',
                'email'				=>	'required|email|unique:users,email',
                'password'			=>	'required',
                'role_id'			=>	'required|role_custom',
            ];
        } //end if

        $errors = check( $request -> all(), $validates );

        if( ! is_null( $errors ) )
            return response( [
                        'field' => $errors[ 'key' ],
                        'msg'   => $errors[ 'msg' ],
                    ], 400 );

        // $request -> authenticated_user = auth()->user();

        return $next( $request );
    }
}
