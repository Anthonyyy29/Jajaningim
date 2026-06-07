<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('games')->insert([
            ['nama_game' => 'Mobile Legends',     'gambar_game' => 'mlbb.png'],
            ['nama_game' => 'Free Fire',           'gambar_game' => 'freefire.png'],
            ['nama_game' => 'Call of Duty Mobile', 'gambar_game' => 'codm.png'],
            ['nama_game' => 'PUBG Mobile',         'gambar_game' => 'pubg.png'],
            ['nama_game' => 'Genshin Impact',      'gambar_game' => 'genshin.png'],
        ]);
    }
}
