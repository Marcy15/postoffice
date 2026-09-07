# Postoffice

Laravel MVC CRUD alkalmazás a `counties`, `cities` és `population` táblákhoz. A projekt kizárólag `counties` táblát használ, `countries` tábla nincs és nem szükséges.

## Funkciók

- Megyék, városok és lakossági adatok: lista, keresés, létrehozás, szerkesztés, törlés
- Minden lista ID szerint növekvő sorrendben jelenik meg
- Megyei címer oszlop külső, közvetlen kép URL-ekkel
- Véletlen lakossági érték generálása minden városhoz
- Üres adatbázisból létrehozható és feltölthető counties/cities adatokkal

## Gyors indítás

A részletes Windows/XAMPP leírás a `SETUP_WINDOWS.md` fájlban található.

1. Hozz létre egy szabványos Laravel 12 projektet: `composer create-project laravel/laravel postoffice`
2. Másold át ebbe a repositoryba a saját alkalmazáskódot: `app`, `routes`, `resources`, `database`, `.env.example`.
3. A projekt gyökerében futtasd: `copy .env.example .env`
4. Állítsd be a MySQL adatbázist a `.env` fájlban.
5. Másold a forrás `postoffice.sql` fájlt ide: `database/seeders/data/postoffice.sql`
6. Futtasd: `php artisan key:generate`
7. Futtasd: `php artisan migrate:fresh --seed`
8. Futtasd: `php artisan serve`
9. Nyisd meg a `http://127.0.0.1:8000` címet.

A seedeléskor a `counties` rekordok töltődnek be először, és csak ezután a `cities` rekordok. A counties név nem egyedi, ezért a dumpban szereplő két `Szepes` rekord is importálható.
