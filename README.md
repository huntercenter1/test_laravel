<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Prueba Técnica – Dev PHP (Laravel 11 + MySQL)

CRUD de Personas con validaciones en cliente (JS) y servidor (PHP).
Cumple con los 5 tipos de campos solicitados:

Text: name

Textarea: description

Radio: gender (M/F)

Checkbox: hobbies[] (JSON)

Select: country_id (relación con countries)

Incluye:

Programación orientada a objetos (Modelos, Controlador, Vistas Blade).

Mensajes de éxito y error.

Control de errores (try/catch + logs).

Base de datos versionada con migraciones y seeders (idempotentes).

1) Requisitos

PHP >= 8.2 (con extensión pdo_mysql)

Composer

MySQL 8.x (o MariaDB 10.6+)

(Opcional) Node/NPM si deseas compilar assets, pero no es necesario para esta prueba.

2) Clonar el repositorio
git clone https://github.com/huntercenter1/test_laravel.git 

3) Configuración de entorno (.env)

Crea tu archivo .env (o duplica .env.example si existe):

cp .env.example .env


Asegúrate de configurar MySQL (no SQLite). Reemplaza valores según tu entorno:

APP_NAME="Prueba PHP"
APP_ENV=local
APP_KEY=            # se genera en el paso 6
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# Base de datos: MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prueba_php
DB_USERNAME=laravel
DB_PASSWORD=laravel_secret


Si usas otras credenciales/puerto, ajústalas aquí.

4) Crear la base de datos (MySQL)

Si ya tienes una DB/usuario, puedes saltarte este paso.
A continuación se muestra el orden correcto y los comandos exactos:

Entrar a MySQL como root (en Linux/WSL suele autenticar por socket):

sudo mysql


Crear DB, usuario y permisos:

CREATE DATABASE IF NOT EXISTS prueba_php
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER IF NOT EXISTS 'laravel'@'localhost' IDENTIFIED BY 'laravel_secret';
GRANT ALL PRIVILEGES ON prueba_php.* TO 'laravel'@'localhost';
FLUSH PRIVILEGES;
EXIT;


Probar conexión (opcional pero recomendado):

mysql -u laravel -p -h 127.0.0.1 -D prueba_php -e "SELECT DATABASE();"
# Password: laravel_secret

5) Instalar dependencias PHP
composer install

6) Generar APP_KEY y limpiar cachés
php artisan key:generate
php artisan optimize:clear

7) Migraciones y seeders
# Crea el esquema y llena datos básicos (países y usuario demo)
php artisan migrate --seed


Seeders idempotentes: puedes ejecutar php artisan db:seed varias veces sin duplicar registros.

8) Levantar el servidor
php artisan serve --host=127.0.0.1 --port=8000


App: http://127.0.0.1:8000

CRUD: http://127.0.0.1:8000/people

9) Credenciales de prueba

Usuario demo (creado por el seeder):
test@example.com / password

No es necesario para navegar el CRUD de ejemplo, pero queda disponible.

10) ¿Qué encontrarás?

Rutas: routes/web.php (resource people)

Controlador: app/Http/Controllers/PersonController.php

Modelos: app/Models/Country.php, app/Models/Person.php

Migraciones: database/migrations/*create_countries_table.php, *create_people_table.php

Seeders: database/seeders/CountrySeeder.php, database/seeders/DatabaseSeeder.php

Vistas: resources/views/people/*, resources/views/layouts/app.blade.php

Formulario (crear/editar) con los 5 tipos de campos, validación en cliente (JS simple en el layout) y validación en servidor ($request->validate()).

Listado con paginación, acciones Editar/Eliminar y mensajes de éxito/error.

11) Comandos útiles
# Ejecutar solo seeder de países
php artisan db:seed --class=CountrySeeder

# Resetear base y resembrar (destructivo)
php artisan migrate:fresh --seed

# Limpiar cachés (útil tras tocar .env)
php artisan optimize:clear

12) Solución de problemas

“Connection: sqlite” o errores con SQLite
Verifica que en .env tengas:

DB_CONNECTION=mysql


y ejecuta:

php artisan optimize:clear


“Access denied for user 'laravel'@'localhost'”
Repite la creación de usuario/privilegios:

DROP USER IF EXISTS 'laravel'@'localhost';
CREATE USER 'laravel'@'localhost' IDENTIFIED BY 'laravel_secret';
GRANT ALL PRIVILEGES ON prueba_php.* TO 'laravel'@'localhost';
FLUSH PRIVILEGES;


Y prueba:

mysql -u laravel -p -h 127.0.0.1 -D prueba_php -e "SELECT 1;"


PHP sin pdo_mysql
Instálalo:

# Debian/Ubuntu
sudo apt install -y php-mysql
php -m | grep -i pdo_mysql


MySQL no arranca / socket no encontrado

sudo service mysql status
sudo service mysql start

13) Cumplimiento de la prueba

OOP: Eloquent Models, Controller, Views.

5 tipos de campos: Text, Textarea, Select, Radio, Checkbox.

Validación: Cliente (JS) + Servidor (PHP).

Mensajes: Éxito/Error visibles en UI.

Errores runtime: Manejo con try/catch y Log::error.

BD versionada: Migraciones + Seeders.