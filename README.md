<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



# Estructura API REST

Esta es una estructura para una API REST con Laravel V.8 que contiene autenticación con OAUTH 2.0 para la protección de rutas, middlewares para el mejor manejo de lo que envía el cliente y existencia de registros antes de ser manipulados en controladores, CRUD de modelos, migraciones y semillas.

## Instalación

Paso 1: Clona el repositorio o descarga el [release](https://github.com/ErickCodeman93/REST_Laravel_v.8_structure/archive/v.1.0.0.zip).

Paso 2: Descarga las dependencias de Composer.

````
composer install
````

Paso 3: Ingresa tus accesos de la base de datos en el archivo .env

Paso 4: Ejecuta una migración con el siguiente comando:

````
php artisan migrate:fresh --seed 
````

Paso 5: Crea las llaves del cliente de passport

````
php artisan passport:install --force 
````

Guardar la clave que tiene el id 2
y adicional en el controlador ShieldController dentro de la carpeta API en donde se encuentran los controladores, cambiar el valor de la constante CLIENT_SECRET por la que nos genero el comando anterior.

````
private const CLIENT_SECRET = 'iqTo9sLoLM...';
````

Nota: La estructura cuenta ya con un usuario y registros de roles en la base de datos con los cuales puedes usar el API.

## Uso de la API

Si realizaste la configuración adecuadamente puedes usar las siguientes credenciales que vienen en las semillas para interactuar con la API:

user : admin@test.com

pass : 12341234

Además de que cuentan con tres roles:

id: 1 - Name: ADMIN_ROLE

id: 2 - Name: VENTAS_ROLE

id: 3 - Name: USER_ROLE

En los headers debe llevar el siguiente valor o no tendras respuesta del API

````
Accept : application/json
````

Las rutas para interactuar con el API son las siguientes:

## - Login

Método: POST

````
{{ localhost o dominio }}/api/app/login
````
data a enviar: 
````
{
	"email" : "admin@test.com",
	"password : "12341234",
}
````

Esta ruta te devolverá un access_token el cual debes guardar para usar en los siguientes endpoints.

Nota: Los siguientes endpoints necesitas estar autenticado, para poderlos usarlos, además de enviar el siguiente valor en los headers en todas las peticiones a estos endpoints.

````
Authorization : Bearer eyJ0eXAiOi... ( este es el access_token que devuelve el login )
````

Obtiene todos los usuarios

Método: GET 

````
{{ localhost o dominio }}/api/app/user
````

Creación de usuarios 

Método: POST

````
{{ localhost o dominio }}/api/app/user
````

data a enviar: 

````
{
    "name" : "user1",
    "email" : "user1@test.com",
    "password" : "12341234",
    "role_id" : ( puedes enviar el id o nombre )
}
````

Obtiene usuarios por id

Método: GET

````
{{ localhost o dominio }}/api/app/user/2
````

Edita usuarios por id

Método: PUT

````
{{ localhost o dominio }}/api/app/user/2
````

data a enviar ( opcional ): 

````
{
    "name" : "user1",
    "email" : "user1@test.com",
    "password" : "12341234",
    "role_id" : ( puedes enviar el id o nombre )
}
````

Elimina usuarios por id

Método: DELETE

````
{{ localhost o dominio }}/api/app/user/2
````

Cierra la sesion del usuario

Método: POST

````
{{ localhost o dominio }}/api/app/logout
````

## Comandos más usados

Crea un proyecto nuevo:

````
composer create-project laravel/laravel name-app  
````
Levanta un servidor local en el puerto que le indiques:
````
php artisan serve --port=8000 o --port=8001
````
Crea un controlador de tipo API e importa el modelo con el cual se quiere manipular:
````
php artisan make:controller API/NameControllerController --api --model=User
````
Crea un archivo de tipo middleware, que luego tiene que ser registrado en el kernel:
````
php artisan make:middleware NameMiddleWareFile 
````
Lista todas las rutas registradas en los archivos que se encuentran en la carpeta routes:
````
php artisan route:list
````
Crea dos archivos, el modelo y su migración correspondiente:
````
php artisan make:model NameModel --migration
````
Crea un archivo que inserta las semillas a los modelos correspondientes:
````
php artisan make:seeder NameSeeder 
````
Realiza la creación, modificación e inserción de tablas y datos en la base de datos 
````
php artisan migrate:fresh --seed 
````
Actualiza las llaves de los clientes de Passport
````
php artisan passport:install --force 
````
Purga el proyecto en caso de que no se vean los cambios de configuraciones:
````
php artisan config:clear
php artisan config:cache
php artisan cache:clear
````
Actualiza las dependencias para su uso en el proyecto:
````
 composer dump-autoload
````


