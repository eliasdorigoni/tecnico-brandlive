# Requisitos:

* NodeJS 12.13.x

# Instrucciones:

1. Clonar repo
1. `composer install`
1. `php bin/console doctrine:database:create`
1. `php bin/console doctrine:schema:update --force`
1. `php bin/console doctrine:fixtures:load`
1. `npm install`
1. `npm run build`