<?php

//Models
use App\Models\User;
use App\Models\Role;

function check( array $request = [], array $validations = [] ){

	$validator = Validator :: make( $request, $validations );
	$errors = $validator -> errors();

	foreach( $validations as $key => $value ) {
		
		if( $errors -> has( $key ) )
				return [ 
						"msg" => $errors -> first( $key ),
						"key" => $key, 
					];
	}	// end foreach
	unset( $key, $value );

} //end function

function isId( $params ){

	$id = null;

	foreach( $params as $param ){
		$id = $param;
	} // end for each
	unset( $param );

	$user = User :: find( $id );

	return $user;

} //end function

function getRole( $value ){

	$userById = Role :: find( $value );

	if( $userById )
		return $userById -> id;

	$userByName = Role :: where( 'name', $value ) -> first();

	if( $userByName )
		return $userByName -> id;

} //end function

