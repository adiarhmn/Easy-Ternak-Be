<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // truncate table with foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('animal_type')->truncate();

        $animalTypes = [
            ['name' => 'Sapi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kambing', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Domba', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kerbau', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('animal_type')->insert($animalTypes);
    }
}
