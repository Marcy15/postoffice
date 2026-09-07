# Postoffice futtatás Windows és XAMPP alatt

## Előfeltételek

- PHP 8.2 vagy újabb
- Composer
- XAMPP MySQL szolgáltatás
- Egy teljes Laravel projektváz

## 1. Tiszta Laravel projekt létrehozása

A jelenlegi repository az alkalmazásfájlokat tartalmazza. Az `artisan`, `bootstrap`, `config`, `public` és `storage` részekhez hozz létre friss Laravel projektet.

```bat
cd "E:\Toro Marcell\postoffice"
composer create-project laravel/laravel postoffice
cd postoffice
```

A létrejött projektbe másold be a GitHub repositoryból ezeket, és írd felül a célfájlokat:

```text
app
routes
resources
database
.env.example
README.md
SETUP_WINDOWS.md
```

Ne másold be vagy ne írd felül a friss Laravel projekt saját `artisan`, `bootstrap`, `config`, `public`, `storage`, `vendor`, `composer.json`, `composer.lock` fájljait.

## 2. Adatbázis létrehozása

Az XAMPP Control Panelben indítsd el a MySQL-t. phpMyAdminban hozz létre egy teljesen üres `postoffice` adatbázist `utf8mb4_unicode_ci` összehasonlítással.

## 3. SQL bemásolása

A kapott `postoffice.sql` fájlt másold ide:

```text
database/seeders/data/postoffice.sql
```

Ha nincs `data` könyvtár, a projekt gyökerében add ki:

```bat
mkdir database\seeders\data
```

A fájlt nem phpMyAdminnal kell importálni. A Laravel seeder fogja belőle a counties és cities adatokat betölteni.

## 4. Környezeti beállítás

A projekt gyökerében:

```bat
copy .env.example .env
php artisan key:generate
```

A `.env` fájlban állítsd ezt:

```env
APP_NAME=Postoffice
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

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

Az `APP_KEY` sort a `php artisan key:generate` tölti ki, ne írd át üresre.

## 5. Táblák és adatok létrehozása

Futtasd ezt az egyetlen parancsot:

```bat
php artisan migrate:fresh --seed
```

Ez törli az aktuális `postoffice` adatbázisban lévő táblákat, majd létrehozza a `counties`, `cities` és `population` táblákat, feltölti a counties és cities sorokat a dumpból, végül a címerlinkeket a megyékhez rendeli.

A parancs ismételhető, de minden futás törli a korábbi saját adatokat a táblákból.

## 6. Indítás

```bat
php artisan optimize:clear
php artisan serve
```

Böngészőben nyisd meg:

```text
http://127.0.0.1:8000
```

A Lakosság menüben kattints a `Véletlen feltöltés városokból` gombra. Ez minden városhoz létrehoz egy véletlen lakossági értéket.

## Gyakori hibák

### Hiányzó sessions tábla

A `.env` fájlban legyen `SESSION_DRIVER=file`, majd futtasd:

```bat
php artisan optimize:clear
```

### Hiányzó postoffice.sql fájl

Ellenőrizd ezt a pontos útvonalat:

```text
database/seeders/data/postoffice.sql
```

### Régi vagy hibás adatbázis

Futtasd újra:

```bat
php artisan migrate:fresh --seed
```

### A program nem az aktuális .env értékeit használja

Futtasd:

```bat
php artisan optimize:clear
```
