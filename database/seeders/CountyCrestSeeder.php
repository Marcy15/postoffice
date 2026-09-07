<?php

namespace Database\Seeders;

use App\Models\County;
use Illuminate\Database\Seeder;

class CountyCrestSeeder extends Seeder
{
    public function run(): void
    {
        $crests = [
            'Bács-Kiskun' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Coa_Hungary_County_B%C3%A1cs-Kiskun.svg/120px-Coa_Hungary_County_B%C3%A1cs-Kiskun.svg.png',
            'Baranya' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Coa_Hungary_County_Baranya.svg/120px-Coa_Hungary_County_Baranya.svg.png',
            'Békés' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Coa_Hungary_County_B%C3%A9k%C3%A9s.svg/120px-Coa_Hungary_County_B%C3%A9k%C3%A9s.svg.png',
            'Borsod-Abaúj-Zemplén' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Coa_Hungary_County_Borsod-Aba%C3%BAj-Zempl%C3%A9n.svg/120px-Coa_Hungary_County_Borsod-Aba%C3%BAj-Zempl%C3%A9n.svg.png',
            'Csongrád' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Coa_Hungary_County_Csongr%C3%A1d.svg/120px-Coa_Hungary_County_Csongr%C3%A1d.svg.png',
            'Fejér' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Coa_Hungary_County_Fej%C3%A9r.svg/120px-Coa_Hungary_County_Fej%C3%A9r.svg.png',
            'Győr-Moson-Sopron' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/Coa_Hungary_County_Gy%C5%91r-Moson-Sopron.svg/120px-Coa_Hungary_County_Gy%C5%91r-Moson-Sopron.svg.png',
            'Hajdú-Bihar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Coa_Hungary_County_Hajd%C3%BA-Bihar.svg/120px-Coa_Hungary_County_Hajd%C3%BA-Bihar.svg.png',
            'Heves' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Coa_Hungary_County_Heves.svg/120px-Coa_Hungary_County_Heves.svg.png',
            'Jász-Nagykun-Szolnok' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Coa_Hungary_County_J%C3%A1sz-Nagykun-Szolnok.svg/120px-Coa_Hungary_County_J%C3%A1sz-Nagykun-Szolnok.svg.png',
            'Komárom-Esztergom' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Coa_Hungary_County_Kom%C3%A1rom-Esztergom.svg/120px-Coa_Hungary_County_Kom%C3%A1rom-Esztergom.svg.png',
            'Nógrád' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Coa_Hungary_County_N%C3%B3gr%C3%A1d.svg/120px-Coa_Hungary_County_N%C3%B3gr%C3%A1d.svg.png',
            'Pest' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Coa_Hungary_County_Pest.svg/120px-Coa_Hungary_County_Pest.svg.png',
            'Somogy' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Coa_Hungary_County_Somogy.svg/120px-Coa_Hungary_County_Somogy.svg.png',
            'Szabolcs-Szatmár-Bereg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Coa_Hungary_County_Szabolcs-Szatm%C3%A1r-Bereg.svg/120px-Coa_Hungary_County_Szabolcs-Szatm%C3%A1r-Bereg.svg.png',
            'Tolna' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Coa_Hungary_County_Tolna.svg/120px-Coa_Hungary_County_Tolna.svg.png',
            'Vas' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Coa_Hungary_County_Vas.svg/120px-Coa_Hungary_County_Vas.svg.png',
            'Veszprém' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Coa_Hungary_County_Veszpr%C3%A9m.svg/120px-Coa_Hungary_County_Veszpr%C3%A9m.svg.png',
            'Zala' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Coa_Hungary_County_Zala.svg/120px-Coa_Hungary_County_Zala.svg.png',
        ];

        foreach ($crests as $name => $crestUrl) {
            County::query()->where('name', $name)->update(['crest_url' => $crestUrl]);
        }
    }
}
