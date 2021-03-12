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
        
    } //end constructor

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCreate = auth()->user();

        $user = User :: all();

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

            $userCreate = auth()->user();
            $data = $request -> all();

            $data[ 'password' ] = bcrypt( $data[ 'password' ] );

            $user = User :: create( $data );

            $output = [
                'status' => 201,
                'msg' => 'Successful operation.',
                'data' => $user,
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
    public function show( User $user, $id )
    {
        dd( $id );
    } //end method

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    } //end method

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    } //end method
} //end class
