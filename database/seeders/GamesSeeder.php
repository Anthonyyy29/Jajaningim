<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('games')->insert([
            ['name' => 'Mobile Legends',     'image' => 'mlbb.png'],
            ['name' => 'Free Fire',           'image' => 'freefire.png'],
            ['name' => 'Call of Duty Mobile', 'image' => 'codm.png'],
            ['name' => 'PUBG Mobile',         'image' => 'pubg.png'],
            ['name' => 'Genshin Impact',      'image' => 'genshin.png'],
        ]);
    }
}
