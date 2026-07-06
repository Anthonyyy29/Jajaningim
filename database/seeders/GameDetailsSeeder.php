<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('game_detail')->insert([
            // Mobile Legends (game_id = 1)
            ['game_id' => 1, 'name' => '11 Diamond', 'price' => 2000, 'label' => 'Diamond'],
            ['game_id' => 1, 'name' => '22 Diamond', 'price' => 4000, 'label' => 'Diamond'],
            ['game_id' => 1, 'name' => '56 Diamond', 'price' => 9000, 'label' => 'Diamond'],
            ['game_id' => 1, 'name' => '112 Diamond', 'price' => 18000, 'label' => 'Diamond'],
            ['game_id' => 1, 'name' => '257 Diamond', 'price' => 40000, 'label' => 'Diamond'],
            ['game_id' => 1, 'name' => '706 Diamond', 'price' => 99000, 'label' => 'Diamond'],
            ['game_id' => 1, 'name' => 'Twilight Pass', 'price' => 149000, 'label' => 'subscription'],

            // Free Fire (game_id = 2)
            ['game_id' => 2, 'name' => '100 Diamond', 'price' => 9000, 'label' => 'Diamond'],
            ['game_id' => 2, 'name' => '310 Diamond', 'price' => 27000, 'label' => 'Diamond'],
            ['game_id' => 2, 'name' => '520 Diamond', 'price' => 45000, 'label' => 'Diamond'],
            ['game_id' => 2, 'name' => '1060 Diamond', 'price' => 90000, 'label' => 'Diamond'],
            ['game_id' => 2, 'name' => 'Weekly Pass', 'price' => 19000, 'label' => 'subscription'],

            // Call of Duty Mobile (game_id = 3)
            ['game_id' => 3, 'name' => '80 CP', 'price' => 13000, 'label' => 'CP'],
            ['game_id' => 3, 'name' => '400 CP', 'price' => 65000, 'label' => 'CP'],
            ['game_id' => 3, 'name' => '800 CP', 'price' => 130000, 'label' => 'CP'],
            ['game_id' => 3, 'name' => 'Battle Pass', 'price' => 149000, 'label' => 'subscription'],

            // PUBG Mobile (game_id = 4)
            ['game_id' => 4, 'name' => '60 UC', 'price' => 14000, 'label' => 'UC'],
            ['game_id' => 4, 'name' => '325 UC', 'price' => 75000, 'label' => 'UC'],
            ['game_id' => 4, 'name' => '660 UC', 'price' => 149000, 'label' => 'UC'],

            // Genshin Impact (game_id = 5)
            ['game_id' => 5, 'name' => '60 Primogem', 'price' => 14000, 'label' => 'Primogem'],
            ['game_id' => 5, 'name' => '330 Primogem', 'price' => 75000, 'label' => 'Primogem'],
            ['game_id' => 5, 'name' => '980 Primogem', 'price' => 149000, 'label' => 'Primogem'],
            ['game_id' => 5, 'name' => 'Blessing', 'price' => 149000, 'label' => 'subscription'],
        ]);
    }
}
