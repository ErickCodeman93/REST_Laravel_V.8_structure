<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

//Models
use App\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend( 'role_custom', function ($attribute, $value, $parameters, $validator) {

            $userById = Role :: find( $value );

            if( $userById )
                return true;
    
            $userByName = Role :: where( 'name', $value ) -> first();

            if( $userByName )
                return true;
            

        });
    }
}
