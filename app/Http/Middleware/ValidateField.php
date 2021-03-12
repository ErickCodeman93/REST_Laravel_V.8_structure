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
                'role'			    =>	'in:ADMIN_ROLE,VENTAS_ROLE,USER_ROLE',
            ];
        } //end if

        $errors = check( $request -> all(), $validates );

        if( ! is_null( $errors ) ){

            return response( [
                        'status' => 400,
                        'field' => $errors[ 'key' ],
                        'msg'   => $errors[ 'msg' ],
                    ], 400 );

        } //end if

        return $next( $request );
    }
}
