<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Data to Settings
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('settings')->truncate();

        $settings = [
            ['name' => 'telephone', 'value' => '08123456789', 'type' => 'number', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'mitra_percent', 'value' => '50', 'type' => 'percent', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'investor_percent', 'value' => '50', 'type' => 'percent', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'app_tax', 'value' => '5', 'type' => 'percent', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('settings')->insert($settings);
    }
}
