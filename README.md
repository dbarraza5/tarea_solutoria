Requisitos del ambiente:  
1.- PHP 7.  
2.- Composer.

Instalar:  
1.- Composer install (dentro de la carpeta del proyecto).  
2.- Crear un archivo vacío de sqlite para la base datos.  
3.- configurar el archivo .env (Crear el archivo sino existe). tipo conexión y la ruta de la base datos.  
```php
DB_CONNECTION=sqlite  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=D:/usuario/htdocs/tarea_solutoria/database/database.sqlite  
DB_USERNAME=root  
DB_PASSWORD=  
```

4.- Insertar el nombre del usuario para consumir la api de los indicadores historicos y poder crear las tablas.

```php
USUARIO_SOLUTORIA = micorreo@gmail.com
```  
5.- hacer la migración la base datos. 

```php
php artisan migrate
``` 
