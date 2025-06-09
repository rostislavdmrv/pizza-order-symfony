# pizza-order-symfony
Simple Symfony app for ordering pizza. Includes a public order form (/order), admin panel to view orders (/admin/orders), and a JSON API (/api/orders). Built with Symfony.
## I.Create project
    1.symfony new {nameOfProject} --webapp
    създавам пълнофункционално Symfony уеб приложение с готова конфигурация за Twig, база данни (Doctrine), Docker, Mailer и други основни компоненти.

## II.Docker
    1.Стартиране на контейнерите
        docker compose up 

    2.Спиране на контейнерите
        docker compose down

## III.Symfony
    1.Стартиране на приложението - Това ще стартира приложението на: https://127.0.0.1:8000
        symfony serve

## IV.Database Load
    1.Зареди тестови данни
        bin/console doctrine:fixtures:load

## V.Run migrations to create tables
    1.bin/console make:migration
    2.bin/console doctrine:migrations:migrate

## VI.Entity
    1.bin/console make:entity Pizza
    2.bin/console make:entity Customer
    3.bin/console make:entity Ingredient

## VII.DBeaver
    1.Тестване на базата данни по време на разработката

## VIII.Technologies Used 
    1.Symfony - 7.3
    2.PHP - 8.4.8

## php.ini
    -разкоментиране на две конфигурации за plsql
    



