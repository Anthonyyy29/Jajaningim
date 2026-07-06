<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('games')->insert([
            [
                'name' => 'Mobile Legends',
                'description' => 'Top up Diamond Mobile Legends dengan harga termurah.',
                'image' => 'mlbb.png',
                'form_fields' => json_encode(['user_id', 'server_id']),
                'is_active' => 'true',
            ],
            [
                'name' => 'Free Fire',
                'description' => 'Top up Diamond Free Fire dengan harga termurah.',
                'image' => 'freefire.png',
                'form_fields' => json_encode(['user_id']),
                'is_active' => 'true',
            ],
            [
                'name' => 'Call of Duty Mobile',
                'description' => 'Top up CP Call of Duty Mobile dengan harga termurah.',
                'image' => 'codm.png',
                'form_fields' => json_encode(['user_id']),
                'is_active' => 'true',
            ],
            [
                'name' => 'PUBG Mobile',
                'description' => 'Top up UC PUBG Mobile dengan harga termurah.',
                'image' => 'pubgm.png',
                'form_fields' => json_encode(['user_id']),
                'is_active' => 'true',
            ],
            [
                'name' => 'Genshin Impact',
                'description' => 'Top up Primogem Genshin Impact dengan harga termurah.',
                'image' => 'genshin.png',
                'form_fields' => json_encode(['user_id', 'server_id']),
                'is_active' => 'true',
            ],
        ]);
    }
}
