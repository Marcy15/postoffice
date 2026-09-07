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

        if (! File::exists($path)) {
            throw new \RuntimeException('Hiányzik a database/seeders/data/postoffice.sql fájl.');
        }

        $sql = File::get($path);
        $counties = $this->extractRows($sql, 'counties');
        $cities = $this->extractRows($sql, 'cities');

        DB::table('population')->delete();
        DB::table('cities')->delete();
        DB::table('counties')->delete();

        foreach (array_chunk($counties, 100) as $chunk) {
            DB::table('counties')->insert($chunk);
        }

        foreach (array_chunk($cities, 500) as $chunk) {
            DB::table('cities')->insert($chunk);
        }
    }

    private function extractRows(string $sql, string $table): array
    {
        $columns = $table === 'counties'
            ? ['id', 'name']
            : ['id', 'zip_code', 'name', 'id_county'];

        $pattern = '/INSERT INTO `?' . $table . '`?\s*\([^)]*\)\s*VALUES\s*(.*?);/si';
        preg_match_all($pattern, $sql, $matches);

        $rows = [];

        foreach ($matches[1] ?? [] as $values) {
            preg_match_all("/\\((\\d+),\\s*(\\d+),\\s*'((?:\\\\'|[^'])*)',\\s*(\\d+)\\)|\\((\\d+),\\s*'((?:\\\\'|[^'])*)'\\)/u", $values, $tuples, PREG_SET_ORDER);

            foreach ($tuples as $tuple) {
                if ($table === 'counties') {
                    $rows[] = [
                        'id' => (int) $tuple[5],
                        'name' => str_replace("\\'", "'", $tuple[6]),
                    ];

                    continue;
                }

                $rows[] = [
                    'id' => (int) $tuple[1],
                    'zip_code' => (int) $tuple[2],
                    'name' => str_replace("\\'", "'", $tuple[3]),
                    'id_county' => (int) $tuple[4],
                ];
            }
        }

        return $rows;
    }
}
