<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Middleware
use App\Http\Middleware\ValidateField;

//Models
use App\Models\User;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Middlewares
        $this->middleware( 'verify.fields:user' )->only( 'store' );
        $this->middleware( 'verify.id' )->only( [ 'show', 'update', 'destroy' ] );
        $this->middleware( 'verify.role' )->only( 'destroy' );
        
    } //end constructor

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User :: with( 'role' ) -> get();

        $output = [
            'status' => 200,
            'msg' => 'Successful operation.',
            'data' => $user,
        ];

        return response( $output, $output[ 'status' ] );

    } //end method

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {   
        try {

            $admin =  $request -> user();

            $data = $request -> all();

            $data[ 'password' ] = bcrypt( $data[ 'password' ] );
            $data[ 'role_id' ] = getRole( $data[ 'role_id' ] );

            $user = User :: create( $data );

            $output = [
                'status' => 201,
                'msg' => 'Successful operation.',
                'data' => $user,
                'admin' => $admin,
            ];
        
        } //end try 
        catch( Exeception $error  ) {

            $output = [ 
                'line' => $error -> getLine(),
			    'message'  => $error -> getMessage(),
			    'code'  => $error -> getCode(),
                'status' => 500, 
            ];
            
        } //end catch

        return response( $output, $output[ 'status' ] );

    } //end method

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request, $id )
    {   
        $user = User :: with( 'role' ) -> find( $id );

        $output = [
            'status' => 200,
            'msg' => 'Successful operation.',
            'data' => $user,
        ];

        return response( $output, $output[ 'status' ] );
    } //end method

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {   
        try {
            
            $data = $request -> all();
            $admin =  $request -> user();
            $user = User ::find( $id );

            if( isset( $data[ 'password' ] ) && ! is_null( $data[ 'password' ] ) && ! empty( $data[ 'password' ] ) )
                $data[ 'password' ] = bcrypt( $data[ 'password' ] );

            if( isset( $data[ 'role_id' ] ) && ! is_null( $data[ 'role_id' ] ) && ! empty( $data[ 'role_id' ] ) )    
                $data[ 'role_id' ] = getRole( $data[ 'role_id' ] );

            $user -> update( $data );

            return $output = [
                'status' => 200,
                'msg'   => 'Successful operation.',
                'data'  => $user,
                'admin' => $admin
            ];

        } //end try 
        catch( Exeception $error  ) {

            $output = [ 
                'line' => $error -> getLine(),
                'message'  => $error -> getMessage(),
                'code'  => $error -> getCode(),
                'status' => 500, 
            ];
            
        } //end catch

        return response( $output, $output[ 'status' ] );

    } //end method

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request, $id )
    {
        try {

            $admin =  $request -> user();
            $user = User ::find( $id );

            $user -> delete();

            return $output = [
                'status' => 200,
                'msg'   => 'Successful operation.',
                'data'  => $user,
                'admin' => $admin
            ];

        } //end try 
        catch( Exeception $error  ) {

            $output = [ 
                'line' => $error -> getLine(),
                'message'  => $error -> getMessage(),
                'code'  => $error -> getCode(),
                'status' => 500, 
            ];
            
        } //end catch

        return response( $output, $output[ 'status' ] );
    } //end method
} //end class
