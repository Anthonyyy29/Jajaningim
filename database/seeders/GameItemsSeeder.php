<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameItemsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('game_items')->insert([
            // Mobile Legends (id_game = 1)
            ['id_games' => 1, 'label_item' => '11 Diamond',    'price' => 2000,   'type' => 'non_subscription'],
            ['id_games' => 1, 'label_item' => '22 Diamond',    'price' => 4000,   'type' => 'non_subscription'],
            ['id_games' => 1, 'label_item' => '56 Diamond',    'price' => 9000,   'type' => 'non_subscription'],
            ['id_games' => 1, 'label_item' => '112 Diamond',   'price' => 18000,  'type' => 'non_subscription'],
            ['id_games' => 1, 'label_item' => '257 Diamond',   'price' => 40000,  'type' => 'non_subscription'],
            ['id_games' => 1, 'label_item' => '706 Diamond',   'price' => 99000,  'type' => 'non_subscription'],
            ['id_games' => 1, 'label_item' => 'Twilight Pass', 'price' => 149000, 'type' => 'subscription'],

            // Free Fire (id_game = 2)
            ['id_games' => 2, 'label_item' => '100 Diamond',   'price' => 9000,   'type' => 'non_subscription'],
            ['id_games' => 2, 'label_item' => '310 Diamond',   'price' => 27000,  'type' => 'non_subscription'],
            ['id_games' => 2, 'label_item' => '520 Diamond',   'price' => 45000,  'type' => 'non_subscription'],
            ['id_games' => 2, 'label_item' => '1060 Diamond',  'price' => 90000,  'type' => 'non_subscription'],
            ['id_games' => 2, 'label_item' => 'Weekly Pass',   'price' => 19000,  'type' => 'subscription'],

            // Call of Duty Mobile (id_game = 3)
            ['id_games' => 3, 'label_item' => '80 CP',         'price' => 13000,  'type' => 'non_subscription'],
            ['id_games' => 3, 'label_item' => '400 CP',        'price' => 65000,  'type' => 'non_subscription'],
            ['id_games' => 3, 'label_item' => '800 CP',        'price' => 130000, 'type' => 'non_subscription'],
            ['id_games' => 3, 'label_item' => 'Battle Pass',   'price' => 149000, 'type' => 'subscription'],

            // PUBG Mobile (id_game = 4)
            ['id_games' => 4, 'label_item' => '60 UC',         'price' => 14000,  'type' => 'non_subscription'],
            ['id_games' => 4, 'label_item' => '325 UC',        'price' => 75000,  'type' => 'non_subscription'],
            ['id_games' => 4, 'label_item' => '660 UC',        'price' => 149000, 'type' => 'non_subscription'],

            // Genshin Impact (id_game = 5)
            ['id_games' => 5, 'label_item' => '60 Primogem',   'price' => 14000,  'type' => 'non_subscription'],
            ['id_games' => 5, 'label_item' => '330 Primogem',  'price' => 75000,  'type' => 'non_subscription'],
            ['id_games' => 5, 'label_item' => '980 Primogem',  'price' => 149000, 'type' => 'non_subscription'],
            ['id_games' => 5, 'label_item' => 'Blessing',      'price' => 149000, 'type' => 'subscription'],
        ]);
    }
}
