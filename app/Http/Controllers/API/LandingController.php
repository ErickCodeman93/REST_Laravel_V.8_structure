<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        
        try {
            
            $data = $request -> all();

            $data[ 'password' ] = bcrypt( $data[ 'password' ] );
            $data[ 'role_id' ] = 3;

            $user = User :: create( $data );

            $output = [
                'status' => 201,
                'msg' => 'Successful operation.',
                'data' => $user,
            ];
            
        } //end try 
        catch ( Exception $error ) {
            
            $output = [ 
                'status' => 500, 
                'line' => $error -> getLine(),
			    'message'  => $error -> getMessage(),
			    'code'  => $error -> getCode(),
            ];

        } //end try

        return response( $output, $output[ 'status' ] );

    } //end method

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
