<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CitiesAndCountiesSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/postoffice.sql');
        $sql = File::get($path);

        $sql = preg_replace('/^--.*$/m', '', $sql);
        $sql = preg_replace('/^\/\*!.*?\*\/;?$/m', '', $sql);
        $sql = preg_replace('/^SET .*?;$/mi', '', $sql);
        $sql = preg_replace('/^START TRANSACTION;$/mi', '', $sql);
        $sql = preg_replace('/^COMMIT;$/mi', '', $sql);
        $sql = preg_replace('/^CREATE TABLE.*?;$/msi', '', $sql);
        $sql = preg_replace('/^ALTER TABLE.*?;$/msi', '', $sql);

        preg_match_all('/INSERT INTO `?(counties|cities)`?\s*\([^;]+?\)\s*VALUES\s*(.*?);/si', $sql, $matches, PREG_SET_ORDER);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('cities')->truncate();
        DB::table('counties')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach ($matches as $match) {
            $table = $match[1];
            $statement = 'INSERT INTO `' . $table . '` ' . str_replace('`', '`', substr($match[0], strpos($match[0], '(')));
            DB::unprepared($statement);
        }
    }
}
