# Peticiones al API

Para que las peticiones al API funcionen,  en los headers debe llevar los siguientes valores:

````

Accept : application/json

Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNTU2ZDhhMjIyYTUyZWEyMDNiNGZkY2Q4Y2ExNTIxYzE3YWVkZDg4MjM0YmRiY2Q1YmY1MmJjNT ...

```` 

En caso contrario recibiran la siguiente respuesta

````
{
    "message": "Unauthenticated."
}
````