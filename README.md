Requisitos del ambiente:  
1.- PHP 7.  
2.- Composer.

Instalar:  
1.- Composer install (dentro de la carpeta del proyecto).  
2.- Renombrar el archivo ".env.example" to ".env".  
3.- php artisan key:generate.  
4.- Crear un archivo vacío de sqlite para la base datos.  
5.- Cambiar el tipo conexión y la ruta de la base datos en el archivo .env.  
```php
DB_CONNECTION=sqlite  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=D:/usuario/htdocs/tarea_solutoria/database/database.sqlite  
DB_USERNAME=root  
DB_PASSWORD=  
```

6.- Insertar el nombre del usuario para consumir la api de los indicadores historicos y poder crear las tablas.

```php
USUARIO_SOLUTORIA = micorreo@gmail.com
```  
7.- hacer la migración la base datos. 

```php
php artisan migrate
``` 
