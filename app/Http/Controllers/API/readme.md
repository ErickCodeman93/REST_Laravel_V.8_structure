# Instalación de OAuth2

## Paso 1
Se debe iniciar con la instalación del paquete en la terminal

```
composer require laravel/passport
```

## Paso 2
Al Modelo Usuario debe tener unas dependencias adicionales :


En la parte superior se debe agregar estas lineas
```
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
```

Dentro de la clase, llamar las dependencias
```
class User extends Authenticatable
{
	use HasApiTokens, Notifiable, SoftDeletes;
```

No olvidar proteger el softdelete

```
 protected $dates = [
		'deleted_at',
	];
```
y en la migración agregar el softdelete

```
 $table->softDeletes();
```
## Paso 3

Hacer una migración ya despues de haber instalado el paquetes de passport en la terminal

````
php artisan migrate
````

Crear las llaves necesarias para generar el token en la terminal

````
php artisan passport:install
````

Guardar Password grant client que te entrega la terminal.
````
Password grant client created successfully.
Client ID: 2
Client secret: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
````

## Paso 4

Configurar el archivo que esta dentro de config -> auth.php

En el apartado "Authentication Guards" 

cambiar de driver => auth a driver => passport:

````
 'api' => [
            'driver' => 'passport',
            'provider' => 'users',
            'hash' => false,
        ],
````

## Paso 5

Dentro del archivo que se encuentra en la carperta app -> providers -> AuthServiceProvider.php, agregar  Passport::routes(); dentro de la función boot:

````
 public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        //
    }
````

E importar passport dentro en las parte superior

````
use Laravel\Passport\Passport;
````

## Paso 6 
Revisar que las rutas de /oauth/token existan con el siguiente comando

````
 php artisan route:list 
````

Si existen las rutas entonces estan listas para hacer una petición dentro de un controlador con el siguiente código,
no olvides guardar en unas constantes el client id y el id secret que entrego el paso 3.

````
  $response = Http::asForm()->post( 'http://127.0.0.1:8001/oauth/token', 
        [
            'grant_type' => 'password',
            'client_id' => self :: CLIENT_ID,
            'client_secret' => self :: CLIENT_SECRET,
            'username' => $data -> email,
            'password' => $data -> password,
            'scope' => '*',
        ] );
````

NOTA: El código se hizo en el localhost por eso la ruta toda extraña, pero cuando se suba a produccion de debe cambiar por el host correcto.

Por último debe regresar una data parecida a la del siguiente ejemplo:

````
 "token_type": "Bearer",
        "expires_in": 31536000,
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMDU4Njk5NzkzOGEyNzU5Yjc2ODgzZWU4MDMxMmU2Njk4NDU4MGNjYTVjZTNkZTRjNDViOGVlODhiOTZmM..."
````











