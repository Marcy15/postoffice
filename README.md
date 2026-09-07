# Postoffice

Egyszerű Laravel 11 MVC CRUD alkalmazás a `counties`, `cities` és `population` táblák kezelésére.

## Funkciók

- Megyék: lista, létrehozás, szerkesztés és törlés
- Városok: lista, létrehozás, szerkesztés és törlés
- Lakossági adatok: lista, létrehozás, szerkesztés és törlés
- Véletlen lakossági adatok generálása minden városból egy gombbal
- Egyszerű, reszponzív Blade felület
- Nincsenek forráskódbeli megjegyzések

## Adatbázis

A projekt közvetlenül a meglévő `counties`, `cities` és `population` táblaneveket használja. A csatolt `postoffice.sql` dumpban a `cities` tábla `id`, `zip_code`, `name` és `id_county` oszlopokkal, a `counties` tábla `id` és `name` oszlopokkal szerepel.

A `population` táblát a projekt migrációja hozza létre. Egy városhoz legfeljebb egy lakossági rekord tartozhat.

## Telepítés

1. Klónozd a repositoryt, majd lépj be a könyvtárba.
2. Futtasd: `composer install`
3. Másold a környezeti mintát: `copy .env.example .env`
4. Állítsd be a `.env` fájlban a MySQL/MariaDB adatbázis-kapcsolatot.
5. Futtasd: `php artisan key:generate`
6. Importáld a `postoffice.sql` dumpot a `postoffice` adatbázisba.
7. Ha a dumpban még nem létezik, hozd létre a population táblát: `php artisan migrate --path=database/migrations/2026_09_07_000003_create_population_table.php`
8. Indítsd el: `php artisan serve`
9. Nyisd meg: `http://127.0.0.1:8000`

Ha teljesen üres adatbázissal indulsz, minden migrációt futtathatsz a `php artisan migrate` paranccsal, majd a felületen kézzel vehetsz fel megyéket és városokat.

## Használat

- A Megyék és Városok menüpontokban megtalálható az összes CRUD művelet.
- A Lakosság oldalon a `Véletlen feltöltés városokból` gomb törli a korábbi lakossági sorokat, majd minden `cities` rekordhoz 100 és 200 000 közötti véletlen lakosságot készít.
- A város törlése a hozzá tartozó lakossági rekordot is törli.
