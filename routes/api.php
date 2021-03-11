<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\API\ShieldController;
use App\Http\Controllers\API\LandingController;

//Middleware
use App\Http\Middleware\ValidateField;

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

Route::post( '/register', [ LandingController::class, 'store' ] ) 
		-> middleware( [ 'verify.fields:signIn' ] );

Route::post( '/login', [ ShieldController::class, 'app' ] )
		-> middleware( [ 'verify.fields:login' ] );

//Probar el token que genera el login en algun controllador