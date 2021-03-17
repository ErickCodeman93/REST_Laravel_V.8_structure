<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\API\ShieldController;
use App\Http\Controllers\API\LandingController;
use App\Http\Controllers\API\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route :: group( [ 
	'prefix' => 'app',
 ], function() {

	Route :: middleware( [ 'verify.fields:signIn' ] ) 
		-> post( '/signin', [ LandingController::class, 'store' ] );

	Route :: middleware( [ 'verify.fields:login' ] )
		-> post( '/login', [ ShieldController::class, 'app' ] );


		
	Route :: middleware ( [ 'auth:api' ] ) 
		-> group( function(){

			Route :: post( '/logout', [ ShieldController::class, 'logout' ] );

			Route::apiResources( [ 	
				'user' => UserController::class 
			] ) ;
	} );

} );





//Probar el token que genera el login en algun controllador