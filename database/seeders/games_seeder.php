<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class games_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('table_games')->insert([
            ['nama_game' => 'Mobile Legends', 'gambar_game' => 'assets/logo_game/mlbb.png'],
            ['nama_game' => 'Free Fire', 'gambar_game' => 'assets/logo_game/freefire.png'],
            ['nama_game' => 'Call of Duty Mobile', 'gambar_game' => 'assets/logo_game/codm.png'],
            ['nama_game' => 'PUBG Mobile', 'gambar_game' => 'assets/logo_game/pubgm.png'],
            ['nama_game' => 'Genshin Impact', 'gambar_game' => 'assets/logo_game/genshin.png'],
        ]);
    }
}
