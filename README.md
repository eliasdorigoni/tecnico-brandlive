# Requisitos:

* NodeJS 12.13.x

# Instrucciones:

1. Clonar repo
1. Crear el archivo `.env.local` con la conexión de base de datos: `DATABASE_URL="mysql://user:pass@127.0.0.1:3306/table_name?serverVersion=mariadb-10.3.27"`
1. `composer install`
1. `php bin/console doctrine:database:create`
1. `php bin/console doctrine:migrations:migrate`
1. `php bin/console doctrine:fixtures:load`
1. `npm install`
1. `npm run build` (si da error en Windows, ejecutar `npm install win-node-env` y volver a correr el comando)

El sistema fue desarrollado en:
* Nginx 1.14.2
* MariaDB 10.3.27
* PHP 7.4.15