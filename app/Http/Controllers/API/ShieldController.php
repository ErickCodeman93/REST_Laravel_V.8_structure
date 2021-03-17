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
	
	private const CLIENT_SECRET = 'iqTo9sLoLMyTQvDvbUATX0Mc7qggYHYxxjVFLT8h';
    
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
                    'status' => 200, 
                    'msg' => 'Successful operation.',
                    'data' => $response->json(),
                ];
            } //end if
            else {

                $output = [
                    'status' => 400, 
                    'msg' => 'No existe el usuario',
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

    public function logout( Request $request ) {
		// Revoke tokens
		foreach( $request -> user() -> tokens ?? [] as $token ) {
			$token -> revoke();
		}	// end foreach
		unset( $token );

		$output = [
			'status' => 200,
			'message' => 'Successful operation.',
		];

        return response( $output, $output[ 'status' ] );
	}	// end method
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
