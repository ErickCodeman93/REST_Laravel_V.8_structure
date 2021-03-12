<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp;
use App\Models\User;

class ShieldController extends Controller
{

    private const CLIENT_ID = 2;
	
	private const CLIENT_SECRET = 'Wnj5CI5JuaEtA5nMmkVmPSLCw7JuVrnUCUztL1be';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function app( Request $request )
    {   
        return $this -> login( $request );
        
    } //end method


    private function login( Request $request ) {

        try {
            
            $data = ( object ) $request -> all();

            /**TODO:
             * Segmentar en más métodos la funcion de obtener el token
             * Faltan validaciones, si existe el usuario 
             * Hacerun middleware para que obtenga el token 
             * 
            */

            $userExist = User::where( 'email', $data -> email ) -> first();

            if( $userExist ){
    
                $response = Http::asForm()->post( 'http://127.0.0.1:8001/oauth/token', 
                [
                    'grant_type' => 'password',
                    'client_id' => self :: CLIENT_ID,
                    'client_secret' => self :: CLIENT_SECRET,
                    'username' => $data -> email,
                    'password' => $data -> password,
                    'scope' => '*',
                ] );
     
                $output = [
                    'data' => $response->json(),
                    'message' => 'Hola Mundo login',
                    'status' => 200, 
                ];
            } //end if
            else {

                $output = [
                    'msg' => 'No existe el usuario',
                    'status' => 400, 
                ];
            } //end else

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

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
