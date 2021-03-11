<?php
use Exception;
use Validator;

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