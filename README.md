# Postoffice

Egyszerű Laravel MVC CRUD alkalmazás a `counties`, `cities` és `population` táblák kezelésére.

## Funkciók

- Megyék, városok és lakossági adatok: lista, létrehozás, szerkesztés és törlés
- Minden lista ID szerint növekvő sorrendben jelenik meg
- Keresés mindhárom listában
- Megyei címer oszlop közvetlen Wikimedia Commons kép-linkekkel
- Lakossági adatok véletlen generálása minden városhoz
- A `counties` és `cities` táblák adatainak seederes feltöltése

## Telepítés

1. Hozz létre egy tiszta Laravel projektet: `composer create-project laravel/laravel postoffice`
2. Másold bele ebből a repositoryból az `app`, `routes`, `resources` és `database` könyvtárakat.
3. Másold a `.env.example` fájlt `.env` néven.
4. A `.env` fájlban állítsd be a MySQL kapcsolatot, és használd ezeket a helyi beállításokat:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=postoffice
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

5. Futtasd: `php artisan key:generate`
6. Futtasd: `php artisan migrate`
7. Másold a saját `postoffice.sql` dumpodat ide: `database/seeders/data/postoffice.sql`
8. Futtasd: `php artisan db:seed`
9. Indítsd el: `php artisan serve`

## Megjegyzés az adatokhoz

A `CitiesAndCountiesSeeder` a `database/seeders/data/postoffice.sql` fájlból csak a `counties` és `cities` táblák `INSERT` utasításait tölti be. A seeder előtt a `counties` és `cities` táblákat kiüríti, ezért futtatása csak akkor ajánlott, ha ezeket az adatokat újra akarod tölteni.

A `CountyCrestSeeder` a meglévő megye-nevekhez hozzáadja a `crest_url` értékeket. A címerképek a Wikimedia Commons közvetlen kép URL-jei.

## Használat

- A Lakosság oldalon a `Véletlen feltöltés városokból` gomb törli a korábbi lakossági sorokat, majd minden `cities` rekordhoz 100 és 200 000 közötti véletlen lakosságot készít.
- A város törlése a hozzá tartozó lakossági rekordot is törli.
